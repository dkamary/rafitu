<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculeBrand extends Model
{
    protected $table = 'vehicle_brand';
    protected $primaryKey = 'id';
    protected $fillable = ['code', 'name', 'logo', 'is_active'];
    public $timestamps = false;

    protected $modelCount = 0;
    protected $models = null;

    public function getModelCount() : int {
        if($this->modelCount > 0) return $this->modelCount;

        return $this->modelCount = VehiculeModel::where('vehicule_brand_id', '=', (int)$this->id)
            ->where('is_active', '=', 1)
            ->count();
    }

    public function getModels() : Collection {

        return $this->models ?: $this->models = VehiculeModel::where('vehicule_brand_id', '=', (int)$this->id)
            ->where('is_active', '=', 1)
            ->orderBy('label')
            ->get();
    }
}
