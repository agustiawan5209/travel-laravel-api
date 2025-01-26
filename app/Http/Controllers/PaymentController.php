<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * store
     * simpan status pembayaran
     * @param  mixed $booking_id
     * @param  mixed $tanggal
     * @param  mixed $total_bayar
     * @param  mixed $status
     * @return void
     */
    public function store($booking_id,$tanggal, $total_bayar, $status){
        $booking = Booking::find($booking_id);

        $payment = Payment::create([
            'booking_id' => $booking->id,
            'tanggal' => $tanggal,
            'total_bayar' => $total_bayar,
            'status' => $status
        ]);

        return $payment;
    }


    /**
     * update
     * ubah status pembayaran
     * @param  mixed $booking_id
     * @param  mixed $tanggal
     * @param  mixed $total_bayar
     * @param  mixed $status
     * @return void
     */
    public function update($booking_id,$tanggal, $total_bayar, $status){
        $booking = Booking::find($booking_id);

        $payment = Payment::where('booking_id', $booking_id)->first();
        $payment->update([
            'status' => $status
        ]);

        return $payment;
    }


}
