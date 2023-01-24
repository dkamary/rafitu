<?php

namespace App\Http\Controllers;

use App\Models\VehiculeBrand;
use App\Models\VehiculeModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ModelAdminController extends Controller
{
    public function index(int $vehiculeBrand) : View {
        $vehiculeBrand = VehiculeBrand::where('id', '=', $vehiculeBrand)->first();
        $models = $vehiculeBrand->getModels();

        return view('admin.vehicle.model.index', [
            'models' => $models,
            'brand' => $vehiculeBrand,
        ]);
    }

    public function nouveau(int $vehiculeBrand) : View {
        $vehiculeBrand = VehiculeBrand::where('id', '=', $vehiculeBrand)->first();
        $model = new VehiculeModel();

        return view('admin.vehicle.model.set', [
            'brand' => $vehiculeBrand,
            'model' => $model,
        ]);
    }

    public function sauvegarder(Request $request, int $brand) : RedirectResponse {
        // dd($request);
        $id = (int)$request->input('id');
        $vehiculeModel = VehiculeModel::where('id', '=', $id)->first();

        if(!$vehiculeModel) {
            $vehiculeModel = new VehiculeModel();
        }

        $vehiculeModel->code = $request->input('code');
        $vehiculeModel->label = $request->input('label');
        $vehiculeModel->is_active = 1;
        $vehiculeModel->vehicule_brand_id = $brand;
        $vehiculeModel->save();

        $brand = VehiculeBrand::where('id', '=', $brand)->first();

        Session::flash('success', "Le modèle <strong>{$vehiculeModel->label}</strong> pour la marque <strong>{$brand->name}</strong> a été sauvegardé avec succès !");

        return response()->redirectToRoute('admin_model_editer', ['brand' => $brand, 'model' => $vehiculeModel]);
    }

    public function effacer(Request $request) : RedirectResponse {
        // dd($request);
        $model = VehiculeModel::where('id', '=', $request->input('id'))->first();
        if(!$model) {
            Session::flash('warning', 'Le modèle n\'a pas été trouvé !');

            return response()->redirectToRoute('admin_model_editer', ['brand' => (int)$model->vehicule_brand_id, 'model' => $model]);
        }

        $model->is_active = 0;
        $model->save();

        Session::flash('success', 'Le modèle a été effacé avec succès !');

        return response()->redirectToRoute('admin_brand_editer', ['brand' => (int)$model->vehicule_brand_id, 'model' => $model]);
    }

    public function editer(int $brand, int $model) : View {
        $vehicleBrand = VehiculeBrand::where('id', '=', $brand)->first();
        $vehicleModel = VehiculeModel::where('id', '=', $model)->first();

        return view('admin.vehicle.model.set', [
            'brand' => $vehicleBrand,
            'model' => $vehicleModel,
        ]);
    }
}
