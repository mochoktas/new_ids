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

use App\Http\Controllers\PaymentController;

Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment/transaction', [PaymentController::class, 'createTransaction'])->name('payment.transaction');
Route::post('/payment/notification', [PaymentController::class, 'notificationHandler'])->name('payment.notification');
Route::post('/update-payment-status', [PaymentController::class, 'updateStatus']);
Route::get('/sse', [PaymentController::class, 'sse']);
Route::get('/console', [PaymentController::class, 'console']);
Route::get('/stream', [PaymentController::class, 'stream']);
Route::post('/console/update-antrian', [PaymentController::class, 'updateAntrian']);
Route::post('/console/reset-antrian', [PaymentController::class, 'resetAntrian']);

use App\Http\Controllers\WeatherController;

Route::get('/weather', [WeatherController::class, 'index'])->name('weather.index');
Route::post('/weather/show', [WeatherController::class, 'show'])->name('weather.show');
