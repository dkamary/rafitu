<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VehicleGallery;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function verification(Request $request) {
        if($request->isMethod(Request::METHOD_GET)) {

            return view('chauffeur.verification');
        }

        /**
         * @var User $user
         */
        $user = Auth::user();
        if($user->isVerified()) {

            return response()->redirectToRoute('driver_already_verified');
        }

        $user->identification_type_id = $request->input('identification_type_id');
        $user->identification_number = $request->input('identification_number');
        $user->identification_date = $request->input('identification_date');
        $user->licence_number = $request->input('licence_number');

        // dd([
        //     'post' => $_POST,
        //     'request' => $request,
        //     'user' => $user,
        //     'licence_number' => $request->input('licence_number'),
        // ]);

        // identification
        $identification= $request->file('identification_scan');
        $uniqId = uniqid('identification-');
        $identificationFile = $uniqId . '.' . $identification->getClientOriginalExtension();
        $identification->move(public_path('identifications/'), $identificationFile);
        $user->identification_scan = $identificationFile;

        // licence_scan
        $licence= $request->file('licence_scan');
        $uniqId = uniqid('licence-');
        $licenceFile = $uniqId . '.' . $licence->getClientOriginalExtension();
        $licence->move(public_path('licences/'), $licenceFile);
        $user->licence_scan = $licenceFile;

        // technical_check_scan
        $tech= $request->file('technical_check_scan');
        $uniqId = uniqid('technical-');
        $techFile = $uniqId . '.' . $tech->getClientOriginalExtension();
        $tech->move(public_path('technicals/'), $techFile);
        $user->technical_check_scan = $techFile;

        // insurrance_scan
        $issurance = $request->file('insurrance_scan');
        $uniqId = uniqid('insurrance-');
        $issuranceFile = $uniqId . '.' . $issurance->getClientOriginalExtension();
        $issurance->move(public_path('insurrances/'), $issuranceFile);
        $user->insurrance_scan = $issuranceFile;

        // gray_card_scan
        $greyCard = $request->file('gray_card_scan');
        $uniqId = uniqid('gray-card-');
        $greyCardFile = $uniqId . '.' . $greyCard->getClientOriginalExtension();
        $greyCard->move(public_path('gray-cards/'), $greyCardFile);
        $user->gray_card_scan = $greyCardFile;

        // vehicle
        $vehicle = new Vehicule();
        $vehicle->owner_id = (int)$user->id;
        $vehicle->registration = uniqid();
        $vehicle->vehicle_brand_id = (int)$request->input('vehicle_brand');
        $vehicle->vehicle_model_id = (int)$request->input('vehicle_model');
        $vehicle->save();

        $vehicleImage = new VehicleGallery();
        $image = $request->file('vehicle_main_image');
        $uniqId = uniqid('vehicle-');
        $vehicleMainImage = $uniqId . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('vehicles/'), $vehicleMainImage);
        // 'vehicle_id', 'image_uri', 'title', 'description', 'alternate_text', 'rank'
        $vehicleImage->vehicle_id = $vehicle->id;
        $vehicleImage->image_uri = asset('vehicles/' . $vehicleMainImage);
        $vehicleImage->title = "Image principale";
        $vehicleImage->description = "";
        $vehicleImage->alternate_text = "";
        $vehicleImage->rank = 1;
        $vehicleImage->save();

        $user->save();

        return response()->redirectToRoute('driver_verification_in_progress');
    }
}
