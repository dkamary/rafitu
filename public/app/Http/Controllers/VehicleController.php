<?php

namespace App\Http\Controllers;

use App\Models\Managers\VehicleManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function brands() : JsonResponse {
        $brandList = VehicleManager::getAllBrands();
        $brands = [];

        foreach($brandList as $brand) {
            $brands[] = [
                'id' => $brand->id,
                'name' => $brand->name,
            ];
        }

        return response()->json([
            'brands' => $brands,
        ]);
    }

    public function models(Request $request) : JsonResponse {
        $brand = (int)$request->input('brand');
        $modelList = VehicleManager::getModelsByBrand($brand);
        $models = [];

        foreach ($modelList as $model) {
            $models[] = [
                'id' => $model->id,
                'brand' => $brand,
                'name' => $model->label,
            ];
        }

        return response()->json([
            'models' => $models,
        ]);
    }
}
