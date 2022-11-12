<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller
{
    public function index() : View {
        return view('pages.homepage');
    }

    public function staticPage(string $slug) : View {
        $page = Page::where('slug', 'LIKE', $slug)->first();
        if(!$page) throw new NotFoundHttpException('La page demandée est introuvable sur le site');

        return view('pages.static-page', [
            'page' => $page,
        ]);
    }
}
