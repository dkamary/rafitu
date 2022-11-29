<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    const STATUS_CREATED = 'CREATED';
    const STATUS_SAVED = 'SAVED';
    const STATUS_APPROVED = 'APPROVED';
    const STATUS_VOIDED = 'VOIDED';
    const STATUS_COMPLETED = 'COMPLETED';
    const STATUS_PAYER_ACTION_REQUIRED = 'PAYER_ACTION_REQUIRED';

    protected $table = 'order';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'intent', 'status', 'create_time', 'reservation_id', 'payer_id'];
    public $timestamps = false;

    protected $reservation;
    protected $links = null;

    public function getReservation() : ?Reservation {
        return ($this->reservation) ?: $this->reservation = Reservation::where('id', '=', (int)$this->reservation_id)->first();
    }

    public function getLinks() : ?Collection {
        return ($this->links) ? : $this->links = OrderLink::where('order_id', 'LIKE', $this->id)->get();
    }

    public function isSuccess() : bool {
        $status = $this->status;

        return $status == self::STATUS_CREATED
            || $status == self::STATUS_SAVED
            || $status == self::STATUS_APPROVED
            || $status == self::STATUS_COMPLETED ;
    }

    public function isWarning() : bool {
        $status = $this->status;

        return $status == self::STATUS_PAYER_ACTION_REQUIRED;
    }

    public function isError() : bool {
        $status = $this->status;

        return $status == self::STATUS_VOIDED;
    }

    public function getMessage() : string {
        $status = $this->status;

        if($status == self::STATUS_CREATED) return 'Le paiement a été <strong>créé</strong> mais n\'a pas encore été capturé';
        if($status == self::STATUS_SAVED) return 'Le paiement a été <strong>enregistré</strong> mais n\'a pas encore été capturé';
        if($status == self::STATUS_APPROVED) return 'Le paiement a été <strong>approuvé</strong> la récupération du montant est en attente';
        if($status == self::STATUS_COMPLETED) return 'Le paiement a été <strong>effectué</strong> avec succès';
        if($status == self::STATUS_PAYER_ACTION_REQUIRED) return 'Le paiement a été <strong>pris en compte</strong>. L\'action du payeur est requis';
        if($status == self::STATUS_VOIDED) return 'Le paiement a été <strong>pris en compte</strong>. Cependant certaines informations sont vides';

        return 'Le status du paiement n\'a pas pu être déterminé';
    }
}
