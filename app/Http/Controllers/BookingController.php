<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Location;
use App\Models\LocationPrice;
use App\Models\Payment;
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
        $userType = auth()->user()->user_type;
        $query = DB::table('bookings')
            ->leftJoin('locations as pp', 'pp.id', '=', 'bookings.pickup_point')
            ->leftJoin('locations as wt', 'wt.id', '=', 'bookings.where_to')
            ->leftJoin('users as pass_user', 'pass_user.id', '=', 'bookings.passenger_id')
            ->leftJoin('users as dri_user', 'dri_user.id', '=', 'bookings.driver_id')
            ->select(
                'pass_user.name as passenger_name',
                'pass_user.phone_number as passenger_number',
                'dri_user.name as driver_name',
                'dri_user.phone_number as driver_number',
                'bookings.price',
                'pp.location_name as pickup_point',
                'wt.location_name as where_to',
                'bookings.trip_type',
                'bookings.trip_date',
                'bookings.trip_time',
                'bookings.status',
                'bookings.id',
                'bookings.driver_id'
            )->orderBy('bookings.id', 'DESC');
        if ($userType == 'driver'){
            $query = $query->where('bookings.driver_id',auth()->id())->orWhere('bookings.status',0);
        }
        if ($userType == 'passenger'){
            $query = $query->where('bookings.passenger_id',auth()->id());
        }
        $data = $query->paginate(10);
        return view('backend.pages.booking.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function paymentList(Request $request)
    {
        $userType = auth()->user()->user_type;
        $query = DB::table('bookings')
            ->leftJoin('payments', 'bookings.id', '=', 'payments.booking_id')
            ->leftJoin('locations as pp', 'pp.id', '=', 'bookings.pickup_point')
            ->leftJoin('locations as wt', 'wt.id', '=', 'bookings.where_to')
            ->leftJoin('users as pass_user', 'pass_user.id', '=', 'bookings.passenger_id')
            ->leftJoin('users as dri_user', 'dri_user.id', '=', 'bookings.driver_id')
            ->select(
                'bookings.id',
                'pass_user.name as passenger_name',
                'pass_user.phone_number as passenger_number',
                'dri_user.name as driver_name',
                'dri_user.phone_number as driver_number',
                'bookings.price',
                'pp.location_name as pickup_point',
                'wt.location_name as where_to',
                'bookings.trip_type',
                'bookings.trip_time',
                'bookings.status as booking_status',
                'bookings.driver_id',
                'payments.*',
            )
            ->orderBy('bookings.id', 'DESC')
            ->where('bookings.status', 6);
            if ($userType == 'driver'){
                $query = $query->where('bookings.driver_id',auth()->id());
            }
            if ($userType == 'passenger'){
                $query = $query->where('bookings.passenger_id',auth()->id());
            }
        $data = $query->paginate(10);

        return view('backend.pages.booking.payment-list',compact('data'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $passengers = User::latest()->where('user_type', 'passenger')->get();
        $drivers = User::latest()->where('user_type', 'driver')->get();
        $locations = Location::latest()->get();
        return view('backend.pages.booking.create',compact('passengers','drivers', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->selected_quote){
            $priceLocation = LocationPrice::find($request->selected_quote);
            $request->merge([
                'price' => $priceLocation->price,
                'where_to' => $priceLocation->where_to,
                'pickup_point' => $priceLocation->pickup_point
            ]);
        }
        $this->validate($request, [
            'passenger_id' => 'required',
            'trip_type' => 'required',
            'pickup_point' => 'required',
            'where_to' => 'required',
            'price' => 'required',
            'trip_date' => 'required',
            'trip_time' => 'required',
        ]);

        $input = $request->all();
        Booking::create($input);
        return redirect()->route('booking.index')
            ->with('success','Booking Set Successfully and Waiting for Accept');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Booking::find($id)->update([
            'status' => 1,
            'driver_id'=>auth()->id()
        ]);
        return redirect()->route('booking.index')
            ->with('success','Accepted successfully');
    }

    public function tripStatus(string $id, $statusId)
    {
        if ($statusId == 6){
            $booking = Booking::find($id);
            return view('backend.pages.booking.payment',compact('booking'));
        }
        Booking::find($id)->update([
            'status' => $statusId,
            'driver_id'=>auth()->id()
        ]);
        return redirect()->route('booking.index')
            ->with('success','Booking status updated successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Booking::find($id)->update([
            'status' => 2,
            'driver_id'=>auth()->id()
        ]);
        return redirect()->route('booking.index')
            ->with('success','Rejected successfully');
    }

    public function billPay(Request $request, $id)
    {

        $this->validate($request, [
            'amount' => 'required',
            'payment_date' => 'required',
            'payment_type' => 'required',
        ]);
        if ($request->payment_type == 'Bkash'){
            $this->validate($request, [
                'p_bkash_number' => 'required',
                'b_ref_number' => 'required',
            ]);
        }
        if ($request->payment_type == 'Nagad'){
            $this->validate($request, [
                'p_nagad_number' => 'required',
                'n_ref_number' => 'required',
            ]);
        }
        if ($request->payment_type == 'Card'){
            $this->validate($request, [
                'card_number' => 'required',
                'card_name' => 'required',
            ]);
        }

        $input = $request->all();
        Payment::create($input);
        Booking::find($id)->update([
            'status' => 6
        ]);
        return redirect()->route('booking.index')
            ->with('success','Payment Successfully and Thank you.');
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
