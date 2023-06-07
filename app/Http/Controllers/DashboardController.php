<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $totalLocation = Location::all()->count();
        $totalUser = User::all()->count();
        $totalPassenger = User::where('user_type','passenger')->get()->count();
        $totalDriver = User::where('user_type','driver')->get()->count();
        return view('backend.pages.dashboard', compact('totalLocation','totalUser','totalDriver', 'totalPassenger'));
    }
}
