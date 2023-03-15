<?php

namespace App\Models\Managers;

use App\Models\Commission;
use App\Models\CommissionPayment;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Throwable;

class CommissionManager
{

    /**
     * !TODO
     *
     * @param integer $count
     * @return Collection
     */
    public static function getTodo(int $count = 20): Collection
    {
        $commissions = Commission::where('status', 'NOT LIKE', 'PAID')
            ->orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();

        return $commissions;
    }

    public static function getDone(int $count = 20): Collection
    {
        $commissions = Commission::where('status', 'LIKE', 'PAID')
            ->orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();

        return $commissions;
    }

    public static function create(Order $order): CommissionPayment
    {
        // dd([
        //     'order' => $order,
        //     'getId' => $order->getId(),
        //     'id' => $order->id,
        // ]);

        $commissionPayment = CommissionPayment::where('order_id', '=', $order->getId())->first();
        if ($commissionPayment) return $commissionPayment;

        $reservation = $order->getReservation();
        $ride = $reservation->getRide();
        $owner = $ride->getOwner();

        $amount = $reservation->getAmount();

        $commissionPayment = new CommissionPayment();
        $commissionPayment->order_id = $order->getId();
        $commissionPayment->reservation_id = $reservation->id;
        $commissionPayment->amount = $amount;
        $commissionPayment->driver_amount = $amount / (1 + ($reservation->commission / 100));
        $commissionPayment->rafitu_amount = $amount - $commissionPayment->driver_amount;
        $commissionPayment->commission = $reservation->commission;
        $commissionPayment->commission_type = $reservation->commission_type;
        $commissionPayment->created_at = date('Y-m-d H:i:s');
        $commissionPayment->status = CommissionPayment::STATUS_UNPAID;
        $commissionPayment->source = $order->source;
        $commissionPayment->destination = $owner->mobile;

        $commissionPayment->save();

        return $commissionPayment;
    }

    /**
     * Récupérer les commissions impayées
     *
     * @param string $source
     * @param string $date
     * @return Collection
     */
    public static function unpaidCommission(string $source = 'all', ?string $date = null): Collection
    {
        /**
         * @var Builder $builder
         */
        $builder = CommissionPayment::where('status', 'like', CommissionPayment::STATUS_UNPAID)
            ->orderBy('created_at', 'asc');

        if ($date) {
            $builder->whereDate('created_at', '=', $date);
        }

        if ($source != 'all') {
            $builder->where('source', 'like', $source);
        }

        $unpaid = $builder->get();

        return $unpaid;
    }

    /**
     * Récupérer les commissions payées
     *
     * @param string $source
     * @param string $date
     * @return Collection
     */
    public static function paidCommission(string $source = 'all', ?string $date = null): Collection
    {
        /**
         * @var Builder $builder
         */
        $builder = CommissionPayment::where('status', 'like', CommissionPayment::STATUS_PAID)
            ->orderBy('created_at', 'asc');

        if ($date) {
            $builder->whereDate('created_at', '=', $date);
        }

        if (!$source != 'all') {
            $builder->where('source', 'like', $source);
        }

        $paid = $builder->get();

        return $paid;
    }

    public static function executePayment(CommissionPayment $commissionPayment): bool
    {
        $token = null;
        try {
            $token = self::getToken();
        } catch (Throwable $th) {
            Log::critical($th->getMessage(), [
                'method' => __METHOD__,
                'custom_message' => 'Unable to retrieve the token',
            ]);
        }

        if (!$token) return false;

        $curl = curl_init();

        $url = sprintf('https://client.cinetpay.com/v1/transfer/money/send/contact?token=%s&transaction_id=%d&&lang=fr', $token, $commissionPayment->id);
        $ride = $commissionPayment->getRide();
        $owner = $ride->getOwner();
        $phone = parse_phone($owner->mobile);
        $data = [
            [
                'amount' => $commissionPayment->driver_amount,
                'phone' => $phone['number'],
                'prefix' => $phone['prefix'],
                'notify_url' => route('cinetpay_transfert'),
                'client_transaction_id' => $commissionPayment->id,
            ]
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => sprintf('data=%s', urlencode(json_encode($data))),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        if(!$response) {
            $code = curl_errno($curl);
            $message = curl_error($curl);
            Log::critical("Echec lors du transfert d'argent vers `{$owner->getFullname()}`, tel: {$owner->mobile}, montant: {$commissionPayment->driver_amount}", [
                'code' => $code,
                'message' => $message,
            ]);
            $commissionPayment->last_notes = sprintf('FAILED! Code: %d, Message: %s', $code, $message);
            $commissionPayment->save();

            curl_close($curl);

            return false;
        }

        curl_close($curl);

        $result = json_decode($response);
        if(!$result) {
            $code = json_last_error();
            $message = json_last_error_msg();
            Log::critical('Echec lors de l\'interprétation du message de retour', [
                'code' => $code,
                'message' => $message,
                'json' => $response,
            ]);
            $commissionPayment->last_notes = sprintf('FAILED! Code: %d, Message: %s', $code, $message);
            $commissionPayment->save();

            return false;
        }

        if($result->code == 0) {
            Log::info("Transfert d'argent réussi vers `{$owner->getFullname()}`, tel: {$owner->mobile}, montant: {$commissionPayment->driver_amount}", [
                'message' => $result
            ]);
            $commissionPayment->last_notes = $response;
            $commissionPayment->save();

            return true;
        }

        Log::warning("Echec lors du transfert d'argent vers `{$owner->getFullname()}`, tel: {$owner->mobile}, montant: {$commissionPayment->driver_amount}", [
            'code' => $result->code,
            'message' => $result->message .' : ' .$result->description,
        ]);
        $message = $result->message .' : ' .$result->description;
        $commissionPayment->last_notes = sprintf('FAILED! Code: %d, Message: %s', $result->code, $message);
        $commissionPayment->save();

        return false;
    }

    public static function getToken(): ?string
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://client.cinetpay.com/v1/auth/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => sprintf('apikey=%s&password=%s', config('cinetpay.api_key'), config('cinetpay.password')),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        if (!$response) {
            $message = 'Une erreur est survenue: ' . curl_error($curl);
            curl_close($curl);

            throw new Exception($message);
        }

        $result = json_decode($response);
        if (!$result) {
            throw new Exception(json_last_error_msg());
        }

        curl_close($curl);

        if ($result->code == 0) {

            return $result->data->token;
        } else {

            throw new Exception(sprintf('code: %d, message: %s, description: %s', $result->code, $result->message, $result->description));
        }

        return null;
    }
}
