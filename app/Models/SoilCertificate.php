<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoilCertificate extends Model
{
    protected $fillable = [
        'pengajuan_uji_tanah_id',
        'file_path'
    ];

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanUji::class, 'pengajuan_uji_tanah_id');
    }
}