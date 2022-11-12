<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table = 'user_type';
    protected $primaryKey = 'id';
    protected $fillable = ['label', 'is_active',];
    public $timestamps = false;

    public function isAdmin() : bool {
        $id = (int)$this->id;
        $label = $this->label;

        $normal = (($id == 1) && (stripos($label, 'administrateur') !== false));
        if($normal) return true;

        return (stripos($label, 'administrateur') !== false);
    }
}
