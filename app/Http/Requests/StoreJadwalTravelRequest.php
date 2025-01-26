<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJadwalTravelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    // Validasi untuk kolom destinasi, tanggal, jam, dan harga_tiket
    public function rules(): array
    {
        return [
            'destinasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'harga_tiket' => 'required|numeric|min:0',
            'kuota' => 'required|numeric|min:0',
        ];
    }

    // Pesan kesalahan untuk validasi
    public function messages() : array
    {
        return [
            'destinasi.required' => 'Destinasi wajib diisi.',
            'destinasi.string' => 'Destinasi harus berupa teks.',
            'destinasi.max' => 'Destinasi maksimal 255 karakter.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Tanggal harus berupa tanggal yang valid.',
            'waktu.required' => 'waktu wajib diisi.',
            'waktu.date_format' => 'waktu harus dalam format HH:MM.',
            'harga_tiket.required' => 'Harga tiket wajib diisi.',
            'harga_tiket.numeric' => 'Harga tiket harus berupa angka.',
            'harga_tiket.min' => 'Harga tiket minimal 0.',
        ];
    }
}
