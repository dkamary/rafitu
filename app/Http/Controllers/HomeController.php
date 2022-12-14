<?php

namespace App\Http\Controllers;

use App\Models\Managers\TrajetDestinationManager;
use App\Models\Page;
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

        return view('pages.static-page', [
            'page' => $page,
        ]);
    }

    public function longTrajet(int $distance = 30000): View
    {
        $rides = Ride::where('distance', '>=', $distance)
            ->where('departure_date', '>', date('Y-m-d H:i:s'))
            ->orderBy('departure_date', 'ASC')
            ->get();

        return view('pages.ride.list', [
            'rides' => $rides,
            'title' => 'Long Trajet',
            'parameters' => [
                'origin' => new Position(0, 0),
                'destination' => new Position(0, 0),
            ],
        ]);
    }

    public function trajetQuotidien(int $distance = 10000): View
    {
        $rides = Ride::where('distance', '<', $distance)
            ->where('departure_date', '>', date('Y-m-d H:i:s'))
            ->orderBy('departure_date', 'ASC')
            ->get();

        return view('pages.ride.list', [
            'rides' => $rides,
            'title' => 'Trajet Quotidien',
            'parameters' => [
                'origin' => new Position(0, 0),
                'destination' => new Position(0, 0),
            ],
        ]);
    }

    public function rechercherTrajet() : View {
        return view('pages.ride.search', []);
    }
}
