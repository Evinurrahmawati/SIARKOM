<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $table = 'platform'; // Nama tabel sesuai database
    protected $primaryKey = 'id_platform'; // PK yang bukan "id"
    protected $fillable = ['nama_platform']; // Kolom yang bisa di-mass assign

    // Relasi ke akun_platform
    public function akun_platform()
    {
        return $this->hasMany(AkunPlatform::class, 'id_platform', 'id_platform');
    }
}
