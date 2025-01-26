<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jadwal_id',
        'tanggal',
        'status',
    ];

    public function payment(){
        return $this->hasOne(Payment::class, 'booking_id', 'id');
    }
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function jadwal(){
        return $this->hasOne(JadwalTravel::class, 'id', 'jadwal_id');
    }
}
