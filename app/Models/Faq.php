<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'country';
    protected $primaryKey = 'id';
    protected $fillable = ['question', 'answer', 'rank', 'is_active',];
    public $timestamps = false;
}
