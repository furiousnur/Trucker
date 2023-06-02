<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Location::orderBy('id','DESC')->paginate(15);
        return view('backend.pages.location.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.location.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'location_name' => 'required',
        ]);

        $input = $request->all();
        $user = Location::create($input);
        return redirect()->route('location.index')
            ->with('success','Location created successfully');
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
        $location = Location::find($id);
        return view('backend.pages.location.edit',compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'location_name' => 'required'
        ]);

        $input = $request->all();
        $user = Location::find($id);
        $user->update($input);
        return redirect()->route('location.index')
            ->with('success','Location updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Location::find($id)->delete();
        return redirect()->route('location.index')
            ->with('success','Location deleted successfully');
    }
}
