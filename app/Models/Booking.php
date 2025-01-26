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
}
