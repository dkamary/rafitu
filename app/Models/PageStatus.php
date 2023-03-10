<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageStatus extends Model
{
    const PUBLIEE = 1;
    const BROUILLON = 2;
    const ARCHIVEE = 3;
    const EFFACEE = 4;

    protected $table = 'page_status';
    protected $primaryKey = 'id';
    protected $fillable = [
        'label', 'is_active',
    ];
    public $timestamps = false;
}
