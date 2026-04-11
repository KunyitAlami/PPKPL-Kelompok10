<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProyekModel extends Model
{
    protected $table = 'proyek';

    protected $fillable = [
        'pemilik_id',
        'nama_proyek',
        'lokasi',
        'status',
    ];

    public function pemilik(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pemilik_id');
    }

    public function pengajuanUjiTanah(): HasMany
    {
        return $this->hasMany(SoilTestModel::class, 'proyek_id');
    }
}
