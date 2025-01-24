<?php

namespace App\Http\Controllers;

use App\Models\JadwalTravel;
use Illuminate\Http\Request;

class ValidasiKuotaController extends Controller
{
    public function validasiKuota(Request $request)
    {
        // mengambil data travel berdasarkan id
        $jadwalTravel = JadwalTravel::find($request->jadwal_id);

        // cek apakah data travel ditemukan
        if (!$jadwalTravel) {
            return response()->json(['message' => 'Jadwal travel tidak ditemukan'], 404);
        }
        // cek apakah kuota travel sudah habis
        if ($jadwalTravel->kuota <= 0) {
            return response()->json(['message' => 'Kuota Penumpang penuh'], 400);
        }

        // Decrease the kuota by 1
        $jadwalTravel->kuota -= 1;
        $jadwalTravel->save();

        return response()->json(['message' => 'Kuota berhasil dikurangi', 'sisa_kuota' => $jadwalTravel->kuota], 200);
    }
}
