<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculeModel extends Model
{
    protected $table = 'vehicle_model';
    protected $primaryKey = 'id';
    protected $fillable = ['vehicule_brand_id', 'code', 'label', 'is_active',];
    public $timestamps = false;
}
