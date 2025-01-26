<?php

namespace App\Http\Controllers;

use App\Models\JadwalTravel;
use App\Http\Requests\StoreJadwalTravelRequest;
use App\Http\Requests\UpdateJadwalTravelRequest;

class JadwalTravelController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $jadwalTravels = JadwalTravel::all();
        return response()->json($jadwalTravels);
    }

    // Store a newly created resource in storage.
    public function store(StoreJadwalTravelRequest $request)
    {
        $validated = $request->validated();
        $jadwalTravel = JadwalTravel::create($validated);
        return response()->json([
            'message' => 'Jadwal Travel berhasil ditambahkan',
            'data' => $jadwalTravel,
        ], 201);
    }

    // Display the specified resource.
    public function show(JadwalTravel $jadwalTravel)
    {
        return response()->json([
            'message' => 'Jadwal Travel',
            'data' => $jadwalTravel,
        ], 201);
    }

    // Update the specified resource in storage.
    public function update(UpdateJadwalTravelRequest $request, JadwalTravel $jadwalTravel)
    {
        $validated = $request->validated();
        $jadwalTravel->update($validated);
        return response()->json([
            'message' => 'Jadwal Travel berhasil Update',
            'data' => $jadwalTravel,
        ], 201);
    }

    // Remove the specified resource from storage.
    public function destroy(JadwalTravel $jadwalTravel)
    {
        $jadwalTravel->delete();
        return response()->json(null, 204);
    }
}
