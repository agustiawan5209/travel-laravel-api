<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\JadwalTravel;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bookings = Booking::with(['jadwal', 'payment'])->when($request->user_id, function ($query) use ($request) {
            $query->where("user_id", $request->user_id);
        })->get();


        return response()->json([
            'message' => 'data berhasil diambil',
            'data' => $bookings
        ]);
    }

    public function getBookingById(Request $request, $id){
        $booking = Booking::findOrFail($id);
        return response()->json([
            'message' => 'data berhasil diambil',
            'data' => $booking,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        // Cari jadwal berdasarkan ID
        $jadwal = JadwalTravel::find($request->jadwal_id);
        if (!$jadwal) {
            return response()->json(['error' => 'Jadwal tidak ditemukan'], 400);
        }

        // Periksa apakah kuota masih tersedia
        if ($jadwal->kuota <= 0) {
            return response()->json(['error' => 'Kuota sudah penuh'], 400);
        }

        // Kurangi kuota
        $jadwal->kuota -= 1;
        $jadwal->save();

        // Buat booking baru
        $booking = Booking::create([
            'jadwal_id'=> $request->jadwal_id,
            'user_id'=> $request->user_id,
            'tanggal'=> $request->tanggal,
        ]);


        $payment = new PaymentController();
        $payments = $payment->store($booking->id, $request->tanggal, $request->total_bayar, $request->status);
        return response()->json([
            'message' => 'Pemesanan Tiket Travel Berhasil',
            'data' => $booking,
        ], 200);
    }


    // Display the specified resource.
    public function show(Booking $Booking)
    {
        $Booking->load('jadwal', 'payment','user');
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
