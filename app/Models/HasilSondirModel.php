<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilSondirModel extends Model
{
    protected $table = 'j1_hasil_uji_sondir';

    protected $fillable = [
        'lokasi_id',
        'teknisi_id',
        'nilai_qc',
        'nilai_fs',
        'indikator_awal',
    ];

    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(SoilLocationModel::class, 'lokasi_id');
    }

    public function teknisi(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }
}