<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipKonten;
use App\Models\Platform;
use App\Models\AkunPlatform;
use App\Models\TemaKonten;

class MenuController extends Controller
{
    public function menuAdmin()
    {
        // Ambil data paginate dari ArsipKonten (sama seperti yang digunakan di daftar arsip)
        $arsipPaginate = ArsipKonten::paginate(10);
        $jumlahHalaman = $arsipPaginate->lastPage(); // Total halaman

        // Hitung semua data
        $jumlahArsip = ArsipKonten::count();
        $jumlahPlatform = Platform::count();
        $jumlahAkunPlatform = AkunPlatform::count();
        $jumlahTopik = TemaKonten::count();
        $jumlahUnduhan = $jumlahArsip; // Asumsi: semua arsip bisa dicetak PDF

        // Kirim ke view
        return view('admin.menu-admin', [
            'jumlahArsip' => $jumlahArsip,
            'jumlahPlatform' => $jumlahPlatform,
            'jumlahAkunPlatform' => $jumlahAkunPlatform,
            'jumlahHalaman' => $jumlahHalaman,
            'jumlahTopik' => $jumlahTopik,
            
        ]);
    }
}
