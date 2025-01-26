<?php

namespace App\Http\Controllers;

use App\Models\JadwalTravel;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJadwalTravelRequest;
use App\Http\Requests\UpdateJadwalTravelRequest;

class JadwalTravelController extends Controller
{
    // Display a listing of the resource.
    public function index(Request $request)
    {
        $query = JadwalTravel::query();

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        if ($request->filled('waktu_awal')) {
            $query->whereTime('waktu', '>=', $request->waktu_awal);
        }

        if ($request->filled('waktu_akhir')) {
            $query->whereTime('waktu', '<=', $request->waktu_akhir);
        }

        if ($request->filled('destinasi_id')) {
            $query->where('destinasi_id', $request->destinasi_id);
        }

        if ($request->filled('kuota')) {
            $query->where('kuota', '>=', $request->kuota);
        }

        $jadwals = $query->with(['booking'])->get();


        return response()->json([
            'message' => 'data berhasil diambil',
            'data' => $jadwals
        ]);
    }
    // Display a listing of the resource.
    public function getById($id)
    {
        $jadwalTravel = JadwalTravel::with(['booking'])->find($id);
        return response()->json([
            'message' => 'Jadwal Travel berhasil Diambil',
            'data' => $jadwalTravel,
        ], 201);
    }

    // Store a newly created resource in storage.
    public function store(StoreJadwalTravelRequest $request)
    {
        $validated = $request->validated();
        $jadwalTravel = JadwalTravel::with(['booking'])->create($validated);

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
