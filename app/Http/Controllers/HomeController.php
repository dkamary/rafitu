<?php

namespace App\Http\Controllers;

use App\Models\Managers\ParamManager;
use App\Models\Managers\TrajetDestinationManager;
use App\Models\Page;
use App\Models\PageCategory;
use App\Models\PageStatus;
use App\Models\Position;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller
{
    public function index(): View
    {
        $randoms = TrajetDestinationManager::random();

        return view('pages.home.index', [
            'randoms' => $randoms,
        ]);
    }

    public function staticPage(string $slug): View
    {
        $page = Page::where('slug', 'LIKE', $slug)->first();
        if (!$page) throw new NotFoundHttpException('La page demandée est introuvable sur le site');
        $page->views++;
        $page->save();

        if($page->page_category_id == PageCategory::BLOG) {
            return view('pages.blog-page', [
                'page' => $page,
            ]);
        }

        return view('pages.static-page', [
            'page' => $page,
        ]);
    }

    public function listPage() : View {
        $pages = Page::where('page_status_id', '=', PageStatus::PUBLIEE)
            ->where('page_category_id', '=', PageCategory::BLOG)
            ->orderBy('id', 'DESC')
            ->paginate(12);

        return view('pages.blog-list', [
            'posts' => $pages,
        ]);
    }

    public function longTrajet(int $distance = 30000): View
    {
        $parameter = ParamManager::getParameters();

        $rides = Ride::where('distance', '>=', $parameter->getDistanceLongTrajet())
            ->where('departure_date', '>', date('Y-m-d H:i:s'))
            ->orderBy('departure_date', 'ASC')
            ->get();

        return view('trajet.liste', [
            'rides' => $rides,
            'title' => 'Long Trajet',
            'parameters' => [
                'origin' => new Position(0, 0),
                'destination' => new Position(0, 0),
            ],
            'meta_description' => 'Le covoiturage pour les longs trajets, c\'est l\'alternative idéale pour les voyages économiques et inoubliables. En voiture…',
        ]);
    }

    public function trajetQuotidien(int $distance = 10000): View
    {
        $rides = Ride::where('has_recurrence', '=', 1)
            ->where('departure_date', '>', date('Y-m-d H:i:s'))
            ->orderBy('departure_date', 'ASC')
            ->get();

        return view('trajet.liste', [
            'rides' => $rides,
            'title' => 'Trajet Quotidien',
            'parameters' => [
                'origin' => new Position(0, 0),
                'destination' => new Position(0, 0),
            ],
            'meta_description' => 'Faire du covoiturage pour les voyages quotidiens, c\'est facile, économique et plus de longue attente',
        ]);
    }

    public function rechercherTrajet() : View {
        return view('pages.ride.search', []);
    }
}
