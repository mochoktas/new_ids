<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    //
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function index()
    {
        // $weather = $this->weatherService->getWeatherByCity('Surabaya');
        // dd($weather);
        return view('Weather.index');
    }

    public function show(Request $request)
    {
        // dd($request);
        if ($request->city == "") {
            $weather = $this->weatherService->getWeatherByPosition($request->lat, $request->lon);
        } else {
            $weather = $this->weatherService->getWeatherByCity($request->city);
        }
        // dd($weather);
        return view('Weather.show', compact('weather'));
    }
}
