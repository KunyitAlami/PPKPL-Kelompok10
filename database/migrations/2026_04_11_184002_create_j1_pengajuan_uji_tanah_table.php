<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('j1_pengajuan_uji_tanah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyek_id')->constrained('proyek');
            $table->foreignId('kontraktor_id')->constrained('users');
            $table->string('jenis_pengujian');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('j1_pengajuan_uji_tanah');
    }
};
