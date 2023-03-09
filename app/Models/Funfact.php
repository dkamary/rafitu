<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funfact extends Model {
    protected $table = 'funfact';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'image', 'icon', 'count', 'created_at', 'is_active',];
    public $timestamps = false;
}
