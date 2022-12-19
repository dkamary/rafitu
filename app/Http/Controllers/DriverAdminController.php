<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DriverAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function index() : View {
        $whereRaw = '('
        .'`identification_scan` IS NOT NULL'
        .' OR `licence_scan` IS NOT NULL'
        .' OR `technical_check_scan` IS NOT NULL'
        .' OR `insurrance_scan` IS NOT NULL'
        .' OR `gray_card_scan` IS NOT NULL'
        .')';

        $qb = DB::table('user')
            ->select(['id'])
            ->where('user_status_id', '<>', 5)
            ->whereRaw($whereRaw, [], 'and');
        $results = $qb->get();

        // dump($qb->toSql());
        // dd($results);

        $ids = [];
        foreach($results as $row) {
            $ids[] = (int)$row->id;
        }

        // dd($ids);

        $queryBuilder = User::whereIn('id', $ids)
        ->orderBy('firstname')
        ->orderBy('lastname');
        $drivers = $queryBuilder->get();

        // dd($queryBuilder->toSql());

        return view('admin.drivers.index', [
            'drivers' => $drivers,
        ]);
    }

    public function list() : View {
        $drivers = User::where('user_status_id', '=', 5)
            ->orderBy('firstname')
            ->orderBy('lastname')
            ->get();

        return view('admin.drivers.index', [
            'drivers' => $drivers,
        ]);
    }

    public function show(User $driver) : View {
        return view('admin.drivers.show', [
            'driver' => $driver,
        ]);
    }

    public function validateDriver(User $driver) : RedirectResponse {
        $driver->user_status_id = 5;
        $driver->save();
        session()->flash('success', sprintf('Chauffeur %s a été validé', $driver->getFullname()));

        return response()->redirectToRoute('admin_driver_show', ['driver' => $driver]);
    }
}
