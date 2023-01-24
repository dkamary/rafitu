<?php

namespace App\Models\Managers;

use App\Models\VehiculeBrand;
use App\Models\VehiculeModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

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

    public static function getList() : array {
        $vehicles = [];
        $list = DB::table('vehicle')
            ->selectRaw('`vehicle`.id as id, `vehicle_brand`.name as brand, `vehicle_model`.label as model')
            ->join('vehicle_brand', 'vehicle.vehicle_brand_id', '=', 'vehicle_brand.id')
            ->join('vehicle_model', 'vehicle.vehicle_model_id', '=', 'vehicle_model.id')
            ->whereRaw('`vehicle`.is_active = ?', [1])
            ->get();
        foreach($list as $row) {
            $vehicles[] = $row;
        }

        return $vehicles;
    }
}
