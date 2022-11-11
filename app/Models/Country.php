<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country';
    protected $primaryKey = 'id';
    protected $fillable = ['code', 'alpha2', 'alpha3', 'name_en', 'name_fr', 'is_active',];
    public $timestamp = false;
}
