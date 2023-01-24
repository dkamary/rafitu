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

    public function toArray() : array
    {

        return [
            'id' => (int)$this->id,
            'question' => $this->question,
            'answer' => $this->answer,
            'rank' => (int)$this->rank,
            'is_active' => $this->is_active == 1,
        ];
    }
}
