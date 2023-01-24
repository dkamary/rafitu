<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RideStatus extends Model
{
    const STATUS_EFFACE = 0;
    const STATUS_PLANIFIE = 1;
    const STATUS_EN_COURS = 2;
    const STATUS_ARRIVEE = 3;
    const STATUS_ANNULE = 4;
    const STATUS_A_VALIDER = 5;

    const STATUS = [
        self::STATUS_EFFACE => 'Effacé',
        self::STATUS_PLANIFIE => 'Planifié',
        self::STATUS_EN_COURS => 'En cours de trajet',
        self::STATUS_ARRIVEE => 'Arrivé',
        self::STATUS_ANNULE => 'Annulé',
        self::STATUS_A_VALIDER => 'A valider',
    ];

    protected $table = 'ride_status';
    protected $primaryKey = 'id';
    protected $fillable = ['label', 'is_active',];
    public $timestamps = false;

    public function __toString() : string
    {
        return $this->label ?: '';
    }

    public static function getStatus(int $status, string $default = 'n/a') : string {
        return self::STATUS[$status] ?? $default;
    }
}
