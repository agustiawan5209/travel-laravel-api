<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\JadwalTravelController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::middleware(['auth:sanctum', 'role:Admin'])->group(function () {
    // Router akses untuk model Destinasi || Admin
    Route::get('/destinasi', [DestinasiController::class, 'index']);
    Route::post('/destinasi', [DestinasiController::class, 'store']);
    Route::post('/destinasi/{destinasi}', [DestinasiController::class, 'update']);
    Route::get('/destinasi/{destinasi}', [DestinasiController::class, 'show']);
    Route::delete('/destinasi/{destinasi}', [DestinasiController::class, 'destroy']);


    // Router akses untuk model Jadwal Travel || Admin
    Route::post('/travel', [JadwalTravelController::class, 'store']);
    Route::post('/travel/{jadwalTravel}', [JadwalTravelController::class, 'update']);
    Route::delete('/travel/{jadwalTravel}', [JadwalTravelController::class, 'destroy']);



    Route::post('/booking/{Booking}', [BookingController::class, 'update']);
    Route::delete('/booking/{Booking}', [BookingController::class, 'destroy']);
});


// Get travel
Route::get('/travel', [JadwalTravelController::class, 'index']);
Route::get('/travel/{jadwalTravel}', [JadwalTravelController::class, 'show']);


Route::middleware(['auth:sanctum', 'role:penumpang'])->group(function () {
    // Router akses untuk model Booking || Admin
    // Route::get('/bookingbyd', [BookingController::class, 'getBookingById']);
    Route::get('/booking', [BookingController::class, 'index']);
    Route::get('/booking/{Booking}', [BookingController::class, 'show']);
    Route::post('/checkout', [BookingController::class, 'store']);
    Route::post('/booking/{Booking}', [BookingController::class, 'update']);
});
