<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LocationPrice;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('location_prices as lp')
            ->leftJoin('locations as pp', 'pp.id', '=', 'lp.pickup_point')
            ->leftJoin('locations as wt', 'wt.id', '=', 'lp.where_to')
            ->select('pp.location_name as pickup_point', 'wt.location_name as where_to', 'lp.price', 'lp.id', 'lp.settings_truck_key', 'lp.settings_truck_value')
            ->orderBy('lp.id', 'DESC');
        $data = $query->paginate(15);
        return view('backend.pages.location-price.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
        $trucks = Setting::whereIn('key', ['large_truck_rate', 'mini_truck_rate'])->get();
        return view('backend.pages.location-price.create',compact('locations', 'trucks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pickup_point' => 'required',
            'where_to' => 'required',
            'price' => 'required',
            'settings_truck_key' => 'required',
        ]);

        $settings = Setting::where('key', $request->settings_truck_key)->first();
        $request->merge(['settings_truck_value' => $settings->value]);
        $input = $request->all();
        LocationPrice::create($input);
        return redirect()->route('location-price.index')
            ->with('success','Location Price set successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $locations = Location::all();
        $locationPrice = LocationPrice::find($id);
        $trucks = Setting::whereIn('key', ['large_truck_rate', 'mini_truck_rate'])->get();
        return view('backend.pages.location-price.edit',compact('locationPrice', 'locations', 'trucks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'pickup_point' => 'required',
            'where_to' => 'required',
            'price' => 'required',
        ]);

        if($request->settings_truck_key != null) {
            $settings = Setting::where('key', $request->settings_truck_key)->first();
            $request->merge(['settings_truck_value' => $settings->value]);
        }
        $input = $request->all();
        $user = LocationPrice::find($id);
        $user->update($input);
        return redirect()->route('location-price.index')
            ->with('success','Location Price updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        LocationPrice::find($id)->delete();
        return redirect()->route('location-price.index')
            ->with('success','Location Price deleted successfully');
    }
}
