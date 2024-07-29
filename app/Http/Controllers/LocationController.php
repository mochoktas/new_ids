<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
class LocationController extends Controller
{
    //
    public function index()
    {
        $locations = Location::all();
        // dd($location);

        return view('map.index', compact('locations'));
    }

    public function index2()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $location = Location::create($request->all());

        return redirect()->route('map.index');
    }

    public function show(Location $location)
    {
        return view('show', compact('location'));
    }
}
