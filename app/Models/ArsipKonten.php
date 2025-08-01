<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipKonten extends Model
{
    use HasFactory;

    protected $table = 'arsip_konten';

    protected $fillable = [
        'id_platform',
        'id_akun',
        'id_tema',        // ✅ Tambahkan ini
        'judul',
        'tanggal',
        'jam',
        'gambar',
        'like',
        'view'
    ];

    public function platform()
    {
        return $this->belongsTo(Platform::class, 'id_platform', 'id_platform');
    }

    public function akun()
    {
        return $this->belongsTo(AkunPlatform::class, 'id_akun', 'id_akun');
    }

    public function tema()
    {
        return $this->belongsTo(TemaKonten::class, 'id_tema');
    }
}
