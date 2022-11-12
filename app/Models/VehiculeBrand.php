<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehiculeBrand extends Model
{
    protected $table = 'vehicle_brand';
    protected $primaryKey = 'id';
    protected $fillable = ['code', 'name', 'logo', 'is_active'];
    public $timestamps = false;
}
