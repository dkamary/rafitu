<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageStatus extends Model
{
    protected $table = 'page_status';
    protected $primaryKey = 'id';
    protected $fillable = [
        'label', 'is_active',
    ];
    public $timestamps = false;
}
