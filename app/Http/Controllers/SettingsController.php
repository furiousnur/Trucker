<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('backend.pages.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $setting = Setting::where('key', $request->key)->first();
        if ($setting) {
            $setting->value = $request->value;
            $setting->save();
        } else {
            $setting = new Setting();
            $setting->key = $request->key;
            $setting->value = $request->value;
            $setting->save();
        }
        return redirect()->back()->with('success', 'Settings saved successfully');
    }
}
