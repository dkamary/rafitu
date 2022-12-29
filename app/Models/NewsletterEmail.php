<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class NewsletterEmail extends Model
{
    protected $table = 'newsletter_email';
    protected $primaryKey = 'id';
    protected $fillable = ['email', 'created_at',];
    public $timestamps = false;

    public function createdAt() : ?DateTime {
        if(!$this->created_at) return null;

        return new DateTime($this->created_at);
    }
}
