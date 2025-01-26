<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreDestinasiRequest;
use App\Http\Requests\UpdateDestinasiRequest;

class DestinasiController extends Controller
{
    /**
     * index
     * Menampilkan data destinasi
     * @return void
     */
    public function index()
    {
        $destinasis = Destinasi::all();
        return response()->json($destinasis);
    }

    // menambahkan data destinasi
    public function store(StoreDestinasiRequest $request)
    {
        // Simpan gambar
        $path = $request->file('image')->store('images', 'public');
        $destinasi = Destinasi::create([
            'image' => env('APP_URL') . '/storage/' . $path,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);
        return response()->json([
            'message' => 'Destinasi berhasil ditambahkan',
            'data' => $destinasi,
        ], 201);
    }

    // menampilkan data destinasi berdasarkan request
    public function show(Destinasi $destinasi)
    {
        return response()->json($destinasi);
    }

    // mengupdate data destinasi
    public function update(UpdateDestinasiRequest $request, Destinasi $destinasi)
    {
        Log::info($request->all());
        $destinasi->update($request->only(['nama', 'deskripsi']));

        if($request->image != null){
            $destinasi->update($request->only(['image']));

        }
        return response()->json([
            'message' => 'Destinasi berhasil ditambahkan',
            'data' => $request->all(),
        ], 201);
    }

    // menghapus data destinasi
    public function destroy(Destinasi $destinasi)
    {
        // Hapus gambar dari storage
        if ($destinasi->image) {
            Storage::disk('public')->delete($destinasi->image);
        }
        $destinasi->delete();
        return response()->json([
            'message' => 'Destinasi berhasil dihapus',
        ], 204);
    }
}
