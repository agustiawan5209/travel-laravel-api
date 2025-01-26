<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('jadwal_id')->constrained('jadwal_travels')->onDelete('cascade');
            $table->date('tanggal');
            $table->enum('status', ['DONE', 'PAID','PENDING','CANCELED'])->comment('Status selesai ketika dibayar, dibayar, menunggu, dibatalkan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
