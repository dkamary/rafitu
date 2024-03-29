<?php

namespace App\Http\Controllers;

use App\Models\Managers\ParamManager;
use App\Models\Managers\VehicleManager;
use App\Models\Message;
use App\Models\Ride;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RideAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function index(Request $request): View
    {
        $builder = Ride::where('id', '>', 0);
            // ->where('ride_status_id', '>', 0)

        $filter = $request->input('filter', 'planifie');
        if ($filter == 'planifie') {
            $builder->where('ride_status_id', '=', 1);
        } elseif ($filter == 'a-valider') {
            $builder->where('ride_status_id', '=', 5);
        } elseif ($filter == 'efface') {
            $builder->where('ride_status_id', '=', 0);
        } elseif ($filter == 'arrive') {
            $builder->where('ride_status_id', '=', 3);
        } elseif ($filter == 'annule') {
            $builder->where('ride_status_id', '=', 4);
        }

        $allRides = $builder
            ->orderBy('departure_date', 'DESC')
            ->paginate(10);

        return view('admin.ride.index', [
            'rides' => $allRides,
            'filter' => $filter,
        ]);
    }

    public function toValidate(): View
    {
        $toValidates = Ride::where('ride_status_id', '=', 5)
            ->orderBy('departure_date', 'DESC')
            ->paginate(10);

        return view('admin.ride.index', [
            'rides' => $toValidates,
        ]);
    }

    public function show(Ride $ride): View
    {

        return view('admin.ride.show', [
            'ride' => $ride,
            'users' => User::where('id', '>', 0)->orderBy('firstname', 'asc')->orderBy('lastname', 'asc')->get(),
            'vehicles' => VehicleManager::getList(),
        ]);
    }

    public function validation(Request $request): JsonResponse
    {
        $ride = Ride::where('id', '=', (int)$request->input('id'))->first();
        $ride->ride_status_id = (int)$request->input('ride_status_id');
        $ride->save();

        return response()->json([
            'done' => true,
            'error' => false,
            'message' => '',
            'ride' => $ride,
        ]);
    }

    public function save(Request $request)
    {
        $ride = Ride::where('id', '=', (int)$request->input('id'))->first();
        // dd($ride);

        if (!$ride) {
            $ride = new Ride();
            $ride->created_at = date('Y-m-d H:i:s');
        } else {
            $ride->updated_at = date('Y-m-d H:i:s');
        }

        $ride->owner_id = $request->input('owner_id');
        $ride->vehicle_id = $request->input('vehicle_id');
        $ride->driver_id = $request->input('driver_id');

        $ride->departure_label = $request->input('departure_label');
        $ride->departure_date = $request->input('departure_date');
        $ride->departure_position_long = $request->input('departure_position_long');
        $ride->departure_position_lat = $request->input('departure_position_lat');

        $ride->arrival_label = $request->input('arrival_label');
        $ride->arrival_date = $request->input('arrival_date');
        $ride->arrival_position_long = $request->input('arrival_position_long');
        $ride->arrival_position_lat = $request->input('arrival_position_lat');

        $ride->seats_available = (int)$request->input('seats_available');
        $ride->woman_only = (int)$request->input('woman_only', null);
        $ride->smokers = (int)$request->input('smokers', null);
        $ride->animals = (int)$request->input('animals', null);
        $ride->talking = (int)$request->input('talking', null);
        $ride->vaccin = (int)$request->input('vaccin', null);
        // $ride->has_recurrence = (int)$request->input('has_recurrence');
        $ride->price = $request->input('price');

        $ride->distance = $request->input('distance');
        $ride->duration = $request->input('duration');

        $ride->ride_status_id = (int)$request->input('ride_status_id');

        $ride->save();

        session()->flash('success', 'Le trajet a été mis à jour!');

        if ($request->isXmlHttpRequest()) {

            return response()->json([
                'done' => true,
                'error' => false,
                'message' => '',
                'ride' => $ride,
            ]);
        }

        return response()->redirectToRoute('admin_ride_index');
        // return response()->redirectToRoute('admin_ride_show', [
        //     'ride' => $ride,
        // ]);
    }

    public function remove(Request $request): RedirectResponse
    {
        $ride = Ride::where('id', '=', (int)$request->input('id'))->first();
        if (!$ride) {
            return response()->redirectToRoute('admin_ride_index');
        }

        $ride->ride_status_id = 0;
        $ride->save();

        session()->flash('success', 'Trajet effacé');

        return response()->redirectToRoute('admin_ride_index');
    }

    public function parameters(Request $request): View
    {
        $parameters = ParamManager::getParameters();
        if ($request->isMethod(Request::METHOD_POST)) {
            $parameters->dist_longtrajet = (int)$request->input('dist_longtrajet', 30000);
            $parameters->save();

            session()->flash('success', 'Paramètre mis à jour');
        }

        return view('admin.ride.parameters', [
            'parameters' => $parameters,
        ]);
    }

    public function republish(Ride $ride): RedirectResponse
    {
        $ride
            ->republish()
            ->save();

        session()->flash('success', sprintf('Le trajet #%d <strong>%s</strong> a été republié sur le site', $ride->id, $ride->toString()));

        return response()->redirectToRoute('admin_ride_show', ['ride' => $ride->id]);
    }
}
