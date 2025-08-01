<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemaKonten extends Model
{
    use HasFactory;

    protected $table = 'tema_konten';         // Nama tabel
    protected $primaryKey = 'id_tema';        // Primary key sebenarnya
    public $incrementing = true;              // Penting: auto-increment?
    protected $keyType = 'int';               // Penting: tipe primary key

    protected $fillable = ['nama_tema'];      // Kolom yang boleh diisi

    // Relasi ke ArsipKonten
    public function arsip()
    {
        return $this->hasMany(ArsipKonten::class, 'id_tema');
    }
}
