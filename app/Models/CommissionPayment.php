<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionPayment extends Model
{
    const STATUS_PAID = 'paid';
    const STATUS_UNPAID = 'unpaid';

    const SOURCE_CINETPAY = 'cinetpay';
    const SOURCE_PAYPAL = 'paypal';

    protected $table = 'commission_payment';
    protected $primaryKey = 'id';
    protected $fillable = ['order_id', 'reservation_id', 'amount', 'driver_amount', 'rafitu_amount', 'commission', 'commission_type', 'created_at', 'updated_at', 'status', 'source', 'destination', 'last_notes'];
    public $timestamps = false;

    protected $order;
    protected $reservation;
    protected $ride;

    public function getOrder() : ?Order {
        return $this->order ?: $this->order = Order::where('id', '=', (int)$this->order_id)->first();
    }

    public function getReservation() : ?Reservation {
        return $this->reservation ?: $this->reservation = Reservation::where('id', '=', (int)$this->reservation_id)->first();
    }

    public function getRide() : ?Ride {
        if($this->ride) return $this->ride;

        $reservation = $this->getReservation();
        if(!$reservation) return null;

        return $this->ride = $reservation->getRide();
    }

    public function getRideLabel(string $default = 'N/A') : string {
        $ride = $this->getRide();
        if(!$ride) return $default;

        return $ride->toString();
    }

    public function getRideOwnerName(string $default = 'N/A') : string {
        $ride = $this->getRide();
        if(!$ride) return $default;

        $owner = $ride->getOwner();

        return $owner ? $owner->getFullname() : $default;
    }

    public function isPaid() : bool {
        return $this->status == self::STATUS_PAID;
    }

    public function paid() : self {
        $this->status = self::STATUS_PAID;
        $this->updated_at = date('Y-m-d H:i:s');

        return $this;
    }

    public function getTransactionId() : string {
        return 'com-' . (int)$this->id;
    }
}
