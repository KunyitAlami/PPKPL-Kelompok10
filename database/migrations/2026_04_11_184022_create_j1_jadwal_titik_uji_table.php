<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('j1_jadwal_titik_uji', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained('j1_pengajuan_uji_tanah');
            $table->foreignId('petugas_lab_id')->constrained('users');
            $table->decimal('latitude', 11, 8);
            $table->decimal('longitude', 11, 8);
            $table->date('tanggal_uji');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('j1_jadwal_titik_uji');
    }
};
