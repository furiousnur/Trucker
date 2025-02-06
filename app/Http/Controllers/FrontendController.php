<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LocationPrice;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function home(Request $request){
        $locations = Location::all();
        $pickupId = $request->pickup_point;
        $destinationId = $request->where_to;
        $quotes = $query = DB::table('location_prices as lp')
            ->leftJoin('locations as pp', 'pp.id', '=', 'lp.pickup_point')
            ->leftJoin('locations as wt', 'wt.id', '=', 'lp.where_to')
            ->select(
                'pp.location_name as pickup_point',
                'wt.location_name as where_to',
                'lp.price', 'lp.id',
                'lp.settings_truck_key',
                'lp.settings_truck_value',
                'lp.created_at'
            )
            ->where('lp.pickup_point', $pickupId)
            ->where('lp.where_to', $destinationId)
            ->get();
        $packaging_rate = Setting::where('key', 'packaging_rate')->first();
        $per_persion_rate = Setting::where('key', 'person_rate')->first();
        return view('frontend.pages.home', compact('locations', 'quotes', 'packaging_rate', 'per_persion_rate'));
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
