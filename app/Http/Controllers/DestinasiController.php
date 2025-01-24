<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
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
        $destinasi = Destinasi::create($request->validated());
        return response()->json($destinasi, 201);
    }
    // menampilkan data destinasi berdasarkan request
    public function show(Destinasi $destinasi, $request)
    {
        return response()->json($destinasi->load('destinasi'));
    }

    // mengupdate data destinasi
    public function update(UpdateDestinasiRequest $request, Destinasi $destinasi)
    {
        $destinasi->update($request->validated());
        return response()->json($destinasi);
    }
    //menhapus data destinasi
    public function destroy(Destinasi $destinasi)
    {
        $destinasi->delete();
        return response()->json(null, 204);
    }
}
