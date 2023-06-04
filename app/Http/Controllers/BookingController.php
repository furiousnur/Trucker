<?php

namespace App\Http\Controllers;

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
            ->leftJoin('location_prices as lp', 'bookings.location_price_id', '=', 'lp.id')
            ->leftJoin('locations as pp', 'pp.id', '=', 'lp.pickup_point')
            ->leftJoin('locations as wt', 'wt.id', '=', 'lp.where_to')
            ->leftJoin('users as pass_user', 'pass_user.id', '=', 'bookings.passenger_id')
            ->leftJoin('users as dri_user', 'dri_user.id', '=', 'bookings.driver_id')
            ->select(
                'pass_user.name as passenger_name',
                'dri_user.name as driver_name',
                'lp.price',
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }
}
