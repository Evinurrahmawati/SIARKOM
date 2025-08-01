<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Kolom-kolom yang boleh diisi secara massal (mass assignment).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username', // ← tambahkan ini
        'email',
        'password',
        'role', // ✅ Tambahkan ini agar bisa menyimpan data role
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi (misalnya saat di-return ke frontend).
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Tipe casting otomatis untuk kolom tertentu.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
