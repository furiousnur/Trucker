<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LocationPrice;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home(){
        $locations = Location::all();
        return view('frontend.pages.home', compact('locations'));
    }

    public function getDestinations($pickupId)
    {
        $destinations = LocationPrice::where('pickup_point', $pickupId)
            ->pluck('where_to')
            ->unique();
        $locationDetails = Location::whereIn('id', $destinations)->get();
        return response()->json($locationDetails);
    }
}
