<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('soil_certificates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pengajuan_uji_tanah_id')
                  ->constrained('j1_pengajuan_uji_tanah')
                  ->cascadeOnDelete();

            $table->string('file_path');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('soil_certificates');
    }
};