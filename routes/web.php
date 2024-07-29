<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });


use App\Http\Controllers\LocationController;
Route::get('/', [LocationController::class, 'index2'])->name('home');
Route::get('/map', [LocationController::class, 'index'])->name('map.index');
Route::post('/store', [LocationController::class, 'store'])->name('map.store');
// Route::get('/show/{location}', [LocationController::class, 'show']);