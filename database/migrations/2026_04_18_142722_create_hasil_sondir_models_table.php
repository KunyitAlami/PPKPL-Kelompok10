<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('j1_hasil_uji_sondir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lokasi_id')->constrained('j1_jadwal_titik_uji')->cascadeOnDelete();
            $table->foreignId('teknisi_id')->constrained('users');
            $table->decimal('nilai_qc', 8, 2); // Perlawanan konus
            $table->decimal('nilai_fs', 8, 2); // Hambatan lekat
            $table->string('indikator_awal'); // Rendah, Sedang, Tinggi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('j1_hasil_uji_sondir');
    }
};