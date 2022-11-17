<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faq';
    protected $primaryKey = 'id';
    protected $fillable = ['question', 'answer', 'rank', 'is_active',];
    public $timestamps = false;

    public static function emptyFaq() : Faq {
        return new Faq([
            'rank' => 255,
            'is_active' => 1,
        ]);
    }
}
