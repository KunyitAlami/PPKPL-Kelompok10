<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanUji extends Model
{
    protected $table = 'j1_pengajuan_uji_tanah';
    protected $fillable = ['user_id', 'lokasi_proyek', 'jenis_pengujian', 'tanggal_keinginan', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function certificate()
    {
        return $this->hasOne(SoilCertificate::class, 'pengajuan_uji_tanah_id');
    }
}