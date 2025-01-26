<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::all();
        return response()->json([
            'message' => 'data berhasil diambil',
            'data' => $bookings
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        $booking = Booking::create([
            'user_id'=> $request->user_id,
            'jadwal_id'=> $request->jadwal_id,
            'tanggal'=> $request->tanggal,
            'status'=> $request->status,
        ]);

        return response()->json([
            'message'=> 'Pemesanan Tiket Travel Berhasil',
            'data'=> $booking,
        ],200);
    }


    // Display the specified resource.
    public function show(Booking $Booking)
    {
        return response()->json([
            'message' => 'Pemesanan',
            'data' => $Booking,
        ], 201);
    }

    // Update the specified resource in storage.
    public function update(UpdateBookingRequest $request, Booking $Booking)
    {
        $validated = $request->validated();
        $Booking->update($validated);
        return response()->json([
            'message' => 'Pemesanan berhasil Update',
            'data' => $Booking,
        ], 201);
    }

    // Remove the specified resource from storage.
    public function destroy(Booking $Booking)
    {
        $Booking->delete();
        return response()->json(null, 204);
    }
}
