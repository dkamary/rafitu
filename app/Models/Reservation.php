<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    const STATUS_CANCEL = 'cancel';
    const STATUS_UNPAID = 'unpaid';
    const STATUS_PAID = 'paid';

    protected $table = 'reservation';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ride_id', 'user_id', 'passenger', 'price', 'is_paid', 'reservation_date', 'payment_date',
        'transaction_id',
        'commission', 'commission_type', 'status',
    ];
    public $timestamps = false;

    protected $ride;
    protected $user;
    protected $order;

    public function getAmount() : float {
        return (float)$this->price * (float)$this->passenger;
    }

    public function __toString() : string
    {
        return $this->toString();
    }

    public function toString() : string {
        $ride = $this->getRide();

        return sprintf('Trajet: %s', $ride ?: 'N/A');
    }

    public function getDescription() : string {
        $ride = $this->getRide();
        $driver = $ride ? $ride->getDriver() : null;

        return sprintf('Trajet: `%s` %sConducteur: `%s`', $ride ?: 'N/A', "\n", $driver?: 'N/A');
    }

    public function getuser() : ?User {
        return ($this->user) ?: $this->user = User::where('id', '=', (int)$this->user_id)->first();
    }

    public function hasUser() : bool {
        return is_null($this->user) ? false : true;
    }

    public function getRide() : ?Ride {
        return ($this->ride) ?: $this->ride = Ride::where('id', '=', (int)$this->ride_id)->first();
    }

    public function isPaid() : bool {
        return ($this->status == self::STATUS_PAID) || ($this->is_paid == 1);
    }

    public function getReservationDate(?string $format = null) {
        $date = new DateTime($this->reservation_date);

        return !$format ? $date : $date->format($format);
    }

    public function getPaymentDate(?string $format = null) {
        $date = new DateTime($this->payment_date);

        return !$format ? $date : $date->format($format);
    }

    public function getOrder() : ?Order {
        return $this->order ?: $this->order = Order::where('reservation_id', '=', (int)$this->id)->first();
    }

    public function getStatus() : ?string {
        $order = $this->getOrder();

        if(is_null($order)) return null;

        return $order->status;
    }

    public function paymentDone() : bool {
        return $this->getStatus() == 'COMPLETED';
    }

    public function cancel() : self {
        $this->status = self::STATUS_CANCEL;
        $this->is_paid = 2;

        return $this;
    }

    public function isCancelled() : bool {
        return $this->status == self::STATUS_CANCEL;
    }

    public function paid() : self {
        $this->status = self::STATUS_PAID;
        $this->is_paid = 1;

        return $this;
    }

    public function unpaid() : self {
        $this->status = self::STATUS_PAID;
        $this->is_paid = 0;

        return $this;
    }

    public function isUnpaid() : bool {
        return is_null($this->status) || $this->status == self::STATUS_UNPAID;
    }

    public function changeStatus(string $status) : self {
        $this->status = $status;

        return $this;
    }
}
