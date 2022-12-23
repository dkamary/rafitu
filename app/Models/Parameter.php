<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $table = 'parameter';
    protected $primaryKey = 'id';
    protected $fillable = [
        'com_longtrajet', 'com_quotidien', 'dist_longtrajet',
    ];
    public $timestamps = false;

    public function getCommissionLongTrajet() : float {
        return (float)$this->com_longtrajet;
    }

    public function getCommissionQuotidien() : float {
        return (float)$this->com_quotidien;
    }

    public function getDistanceLongTrajet() : float {
        return (float)$this->dist_longtrajet;
    }
}
