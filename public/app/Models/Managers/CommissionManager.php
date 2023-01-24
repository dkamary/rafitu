<?php

namespace App\Models\Managers;

use App\Models\Commission;
use App\Models\CommissionPayment;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CommissionManager {

    /**
     * !TODO
     *
     * @param integer $count
     * @return Collection
     */
    public static function getTodo(int $count = 20) : Collection {
        $commissions = Commission::where('status', 'NOT LIKE', 'PAID')
            ->orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();

        return $commissions;
    }

    public static function getDone(int $count = 20) : Collection {
        $commissions = Commission::where('status', 'LIKE', 'PAID')
            ->orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();

        return $commissions;
    }

    public static function create(Order $order) : CommissionPayment {
        // dd([
        //     'order' => $order,
        //     'getId' => $order->getId(),
        //     'id' => $order->id,
        // ]);

        $commissionPayment = CommissionPayment::where('order_id', '=', $order->getId())->first();
        if($commissionPayment) return $commissionPayment;

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
     * @return Collection
     */
    public static function unpaidCommission(string $source = 'all') : Collection {
        /**
         * @var Builder $builder
         */
        $builder = CommissionPayment::where('status', 'like', CommissionPayment::STATUS_UNPAID)
            ->orderBy('created_at', 'asc');

        if($source != 'all') {
            $builder->where('source', 'like', $source);
        }

        $unpaid = $builder->get();

        return $unpaid;
    }

    /**
     * Récupérer les commissions payées
     *
     * @param string $source
     * @return Collection
     */
    public static function paidCommission(string $source = 'all') : Collection {
        /**
         * @var Builder $builder
         */
        $builder = CommissionPayment::where('status', 'like', CommissionPayment::STATUS_PAID)
            ->orderBy('created_at', 'asc');

        if(!$source != 'all') {
            $builder->where('source', 'like', $source);
        }

        $paid = $builder->get();

        return $paid;
    }

    public static function executePayment(CommissionPayment $commissionPayment) : bool {
        return false;
    }
}
