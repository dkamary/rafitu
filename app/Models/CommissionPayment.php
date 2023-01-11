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
    protected $fillable = ['order_id', 'reservation_id', 'amount', 'driver_amount', 'rafitu_amount', 'commission', 'commission_type', 'created_at', 'updated_at', 'status', 'source', 'destination'];
    public $timestamps = false;

    protected $order;
    protected $reservation;

    public function getOrder() : ?Order {
        return $this->order ?: $this->order = Order::where('id', '=', (int)$this->order_id)->first();
    }

    public function getReservation() : ?Reservation {
        return $this->reservation ?: $this->reservation = Reservation::where('id', '=', (int)$this->reservation_id)->first();
    }

    public function isPaid() : bool {
        return $this->status == self::STATUS_PAID;
    }

    public function paid() : self {
        $this->status = self::STATUS_PAID;
        $this->updated_at = date('Y-m-d H:i:s');

        return $this;
    }
}
