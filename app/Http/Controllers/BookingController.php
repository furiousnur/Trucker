<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Location;
use App\Models\LocationPrice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('bookings')
            ->leftJoin('locations as pp', 'pp.id', '=', 'bookings.pickup_point')
            ->leftJoin('locations as wt', 'wt.id', '=', 'bookings.where_to')
            ->leftJoin('users as pass_user', 'pass_user.id', '=', 'bookings.passenger_id')
            ->leftJoin('users as dri_user', 'dri_user.id', '=', 'bookings.driver_id')
            ->select(
                'pass_user.name as passenger_name',
                'dri_user.name as driver_name',
                'bookings.price',
                'pp.location_name as pickup_point',
                'wt.location_name as where_to',
                'bookings.trip_type',
                'bookings.trip_date',
                'bookings.trip_time',
                'bookings.status',
                'bookings.id'
            )
            ->orderBy('bookings.id', 'DESC');
        $data = $query->paginate(15);
        return view('backend.pages.booking.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $passengers = User::latest()->where('user_type', 'passenger')->get();
        $drivers = User::latest()->where('user_type', 'driver')->get();
        $pickupPoints = DB::table('location_prices as lp')
            ->leftJoin('locations as pp', 'pp.id', '=', 'lp.pickup_point')
            ->select('pp.location_name as pickup_point', 'lp.price', 'lp.id')
            ->orderBy('lp.id', 'DESC')->get();
        return view('backend.pages.booking.create',compact('pickupPoints','passengers','drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'passenger_id' => 'required',
            'driver_id' => 'required',
            'trip_type' => 'required',
            'pickup_point' => 'required',
            'where_to' => 'required',
            'price' => 'required',
            'trip_date' => 'required',
            'trip_time' => 'required',
        ]);

        $input = $request->all();
        $user = Booking::create($input);
        return redirect()->route('booking.index')
            ->with('success','Booking set successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Booking::find($id)->update([
            'status' => 1
        ]);
        return redirect()->route('booking.index')
            ->with('success','Accepted successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Booking::find($id)->update([
            'status' => 2
        ]);
        return redirect()->route('booking.index')
            ->with('success','Rejected successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Booking::find($id)->delete();
        return redirect()->route('booking.index')
            ->with('success','Booking deleted successfully');
    }

    public function whereToPrice(string $whereToId, $PickupPointId)
    {
        $price = DB::table('location_prices')->where('where_to', $whereToId)->where('pickup_point', $PickupPointId)->first('price');
        return response()->json($price);
    }

    public function whereToLocation(string $id)
    {
        $locations = DB::table('location_prices')
            ->join('locations', 'location_prices.where_to', '=', 'locations.id')
            ->select('locations.location_name', 'location_prices.where_to', 'location_prices.price')
            ->where('location_prices.pickup_point', $id)
            ->get();
        if (isset($locations) && sizeof($locations)>0){
            return response()->json($locations);
        }else{
            return response()->json("Location Not Found.");
        }
    }
}
