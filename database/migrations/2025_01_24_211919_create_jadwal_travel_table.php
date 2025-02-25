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
        Schema::create('jadwal_travel', function (Blueprint $table) {
            $table->id();
            $table->string('destinasi', 100);
            $table->date('tanggal')->comment('Tanggal keberangkatan');
            $table->time('waktu')->comment('Waktu keberangkatan');
            $table->integer('kuota');
            $table->double('harga_tiket', 10, 2)->comment('Harga tiket per penumpang');
            $table->enum('status', ['DONE','PENDING'])->comment('PENDING jika kuota masih tersedia, DONE jika kuota sudah habis')->default('PENDING');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_travel');
    }
};
