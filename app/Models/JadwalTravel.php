<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTravel extends Model
{
    use HasFactory;

    protected $fillable = ['destinasi', 'tanggal', 'jam', 'harga_tiket', 'kuota_penumpang'];

    protected $casts = [
        'tanggal' => 'date',
        'jam' => 'time',
    ];
}
