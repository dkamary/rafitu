<?php

namespace App\Http\Controllers;

use App\Models\VehiculeBrand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class BrandAdminController extends Controller
{
    public function index(Request $request) : View {
        $builder = VehiculeBrand::where('is_active', '=', 1);
        $search = $request->input('search');
        if(strlen(trim($search)) > 0) {
            $builder->where('name', 'like', '%' . $search . '%');
        }

        $brands = $builder
            ->orderBy('name')
            ->paginate(20);

        return view('admin.vehicle.brand.index', [
            'brands' => $brands,
        ]);
    }

    public function nouveau() : View {
        $brand = new VehiculeBrand();

        return view('admin.vehicle.brand.set', [
            'brand' => $brand,
        ]);
    }

    public function effacer(Request $request) : RedirectResponse {
        $id = $request->input('id');
        $brand = VehiculeBrand::where('id', '=', (int)$id)->first();
        if(!$brand) {
            Session::flash('warning', 'La marque est introuvable !');

            return response()->redirectToRoute('admin_brand_index');
        }

        $brand->is_active = 0;
        $brand->save();

        Session::flash('success', 'La marque a été supprimée !');

        return response()->redirectToRoute('admin_brand_index');
    }

    public function sauvegarder(Request $request) : RedirectResponse {
        $vehiculeBrand = VehiculeBrand::where('id', '=', (int)$request->input('id'))->first();
        if(!$vehiculeBrand) {
            $vehiculeBrand = new VehiculeBrand();
        }

        $vehiculeBrand->code = $request->input('code');
        $vehiculeBrand->name = $request->input('name');
        $vehiculeBrand->is_active = 1;
        $vehiculeBrand->save();

        Session::flash('success', sprintf('La marque `<strong>%s</strong>` a été sauvegardée !', $request->input('name')));

        return response()->redirectToRoute('admin_brand_editer', ['brand' => $vehiculeBrand]);
    }

    public function editer(int $vehiculeBrand) : View {
        $vehiculeBrand = VehiculeBrand::where('id', '=', $vehiculeBrand)->first();

        return view('admin.vehicle.brand.set', [
            'brand' => $vehiculeBrand,
        ]);
    }
}
