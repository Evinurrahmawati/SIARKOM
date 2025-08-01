<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunPlatform extends Model
{
    use HasFactory;

    protected $table = 'akun_platform';
    protected $primaryKey = 'id_akun';
    protected $fillable = ['id_platform', 'nama_akun'];

    public function platform()
    {
        return $this->belongsTo(Platform::class, 'id_platform', 'id_platform');
    }

    // Tambahan: Scope untuk filter akun berdasarkan platform
    public function scopeByPlatform($query, $platformId)
    {
        return $query->where('id_platform', $platformId);
    }

    public function getByPlatform($id)
    {
    $akun = AkunPlatform::where('id_platform', $id)->get();
    return response()->json($akun);
    }

}
