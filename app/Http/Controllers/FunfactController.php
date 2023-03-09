<?php

namespace App\Http\Controllers;

use App\Models\Funfact;
use App\Models\Managers\FunfactManager;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FunfactController extends Controller
{
    public function index() : View {
        $funfacts = Funfact::where('is_active', '=', 1)->get();

        return view('admin.funfact.index', [
            'funfacts' => $funfacts,
        ]);
    }

    public function create() : View {
        $funfact = new Funfact();

        return view('admin.funfact.set', [
            'funfact' => $funfact,
        ]);
    }

    public function edit(Funfact $funfact) : View {
        return view('admin.funfact.set', [
            'funfact' => $funfact,
        ]);
    }

    public function save(Request $request) {
        $id = (int)$request->input('id');
        $funfact = Funfact::where('id', '=', $id)->first();

        if(!$funfact) {
            $funfact = new Funfact();
            $funfact->is_active = 1;
            $funfact->created_at = (new DateTime('now'))->format('Y-m-d H:i:s');
        }

        $funfact->title = $request->input('title');
        $funfact->count = $request->input('count');
        $funfact->save();

        $hasChanged = false;
        if($image = FunfactManager::handleUpload($request, 'image', $funfact)) {
            $funfact->image = $image;
            $hasChanged = true;
        }

        if($icon = FunfactManager::handleUpload($request, 'icon', $funfact)) {
            $funfact->icon = $icon;
            $hasChanged = true;
        }

        if($hasChanged) $funfact->save();

        if($request->isXmlHttpRequest()) {
            return response()->json([
                'done' => true,
                'funfact' => [
                    'title' => $funfact->title,
                    'image' => $funfact->image,
                    'icon' => $funfact->icon,
                    'count' => $funfact->count,
                    'is_active' => $funfact->is_active == 1,
                ],
            ]);
        }

        session()->flash('success', 'Fait amusant mis à jour avec succès!');

        return response()->redirectToRoute('admin_funfact_index');
    }

    public function remove(Request $request) {
        $id = (int)$request->input('id');
        $funfact = Funfact::where('id', '=', $id)->first();
        if($funfact) {
            $funfact->is_active = 0;
            $funfact->save();
        }

        if($request->isXmlHttpRequest()) {
            return response()->json([
                'done' => true,
                'funfact' => [
                    'title' => $funfact->title,
                    'image' => $funfact->image,
                    'icon' => $funfact->icon,
                    'count' => $funfact->count,
                    'is_active' => $funfact->is_active == 1,
                ],
            ]);
        }

        session()->flash('success', 'Fait amusant effacé avec succès!');

        return response()->redirectToRoute('admin_funfact_index');
    }
}
