<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function index() : View {
        return view('admin.pages.index');
    }

    public function charteConfidentialiteEtCookie() : View {
        $user = auth()->user();
        $slug = 'charte-confidentialite-et-cookies';
        $page = Page::where('slug', 'LIKE', $slug)->first();

        return view('admin.pages.edit-text', [
            'user' => $user,
            'page' => $page,
            'route' => 'pages_charte_cookie',
        ]);
    }

    public function conditionUtilisation() : View {
        $user = auth()->user();
        $slug = 'conditions-utilisation';
        $page = Page::where('slug', 'LIKE', $slug)->first();

        return view('admin.pages.edit-text', [
            'user' => $user,
            'page' => $page,
            'route' => 'pages_condition_utilisation',
        ]);
    }

    public function contact() : View {
        $user = auth()->user();
        $slug = 'contact';
        $page = Page::where('slug', 'LIKE', $slug)->first();

        return view('admin.pages.edit-text', [
            'user' => $user,
            'page' => $page,
            'route' => 'pages_contact',
        ]);
    }

    public function newsletter() : View {
        $user = auth()->user();
        $slug = 'newsletter';
        $page = Page::where('slug', 'LIKE', $slug)->first();

        return view('admin.pages.edit-text', [
            'user' => $user,
            'page' => $page,
            'route' => 'pages_newsletter',
        ]);

    }

    public function nosValeurs() : View {
        $user = auth()->user();
        $slug = 'nos-valeurs';
        $page = Page::where('slug', 'LIKE', $slug)->first();

        return view('admin.pages.edit-text', [
            'user' => $user,
            'page' => $page,
            'route' => 'pages_nosValeurs',
        ]);
    }

    public function quiSommesNous() : View {
        $user = auth()->user();
        $slug = 'qui-sommes-nous';
        $page = Page::where('slug', 'LIKE', $slug)->first();

        return view('admin.pages.edit-text', [
            'user' => $user,
            'page' => $page,
            'route' => 'pages_qui_sommes_nous',
        ]);
    }

    public function reglementTrajet() : View {
        $user = auth()->user();
        $slug = 'reglement-trajet';
        $page = Page::where('slug', 'LIKE', $slug)->first();

        return view('admin.pages.edit-text', [
            'user' => $user,
            'page' => $page,
            'route' => 'pages_reglement_trajet',
        ]);
    }

    public function faq() : View {
        $user = auth()->user();
        $slug = 'faq';
        $page = Page::where('slug', 'LIKE', $slug)->first();

        return view('admin.pages.edit-text', [
            'user' => $user,
            'page' => $page,
            'route' => 'pages_faq',
        ]);
    }

    public function editBySlug(string $slug) : View {
        $page = Page::where('slug', 'LIKE', $slug)->first();

        return view('');
    }

    public function saveBySlug(Request $request, string $slug) : RedirectResponse {
        $page = Page::where('slug', 'LIKE', $slug)->first();
        if(!$page) {
            throw new NotFoundHttpException(sprintf('La page avec l\'URL `%s` est introuvable', $slug));
        }

        $page->title = $request->input('title');
        $page->description = $request->input('description');
        $page->content = $request->input('content', '');
        $page->save();

        session()->flash('success', 'Page mis à jour avec succès!');

        return response()->redirectToRoute($request->input('route', 'pages_index'));
    }
}
