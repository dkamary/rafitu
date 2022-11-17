<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrajetDestination extends Model
{
    protected $table = 'trajet_destination';
    protected $primaryKey = 'id';
    protected $fillable = ['departure', 'arrival', 'price'];
    public $timestamps = false;

    public function getPrice(string $currency = 'f CFA') : string {
        return sprintf('%d %s', $this->price, $currency);
    }
}
