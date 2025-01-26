<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTravel extends Model
{
    use HasFactory;

    protected $fillable = ['destinasi', 'tanggal', 'waktu', 'harga_tiket', 'kuota'];

    protected $casts = [
        // 'tanggal' => 'date',
        'waktu' => 'datetime:H:i',
    ];
}
