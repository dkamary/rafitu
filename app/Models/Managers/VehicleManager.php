<?php

namespace App\Models\Managers;

use App\Models\VehiculeBrand;
use App\Models\VehiculeModel;
use Illuminate\Database\Eloquent\Collection;

class VehicleManager {
    public static function getAllBrands() : ?Collection {
        $brands = VehiculeBrand::where('is_active', '=', 1)
            ->orderBy('name')
            ->get();

        return $brands;
    }

    public static function getModelsByBrand(int $brandId ) : ?Collection {
        $models = VehiculeModel::where('is_active', '=', 1)
            ->where('vehicule_brand_id', '=', $brandId)
            ->orderBy('label')
            ->get();

        return $models;
    }
}
