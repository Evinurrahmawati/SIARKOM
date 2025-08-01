<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\AkunPlatformController;
use App\Http\Controllers\ArsipKontenController;
use App\Http\Controllers\ArsipCetakController;
use App\Http\Controllers\TemaKontenController;
use App\Http\Controllers\MenuController;

/*
|--------------------------------------------------------------------------
| AJAX ROUTE
|--------------------------------------------------------------------------
|
| Route ini untuk permintaan AJAX mengambil akun berdasarkan ID platform.
| Tidak memakai middleware agar bisa diakses langsung dari halaman tambah arsip.
|
*/
Route::get('/get-akun-by-platform/{id}', [AkunPlatformController::class, 'getByPlatform']);
Route::get('/get-akun-by-platform', [App\Http\Controllers\ArsipController::class, 'getAkunByPlatform'])
     ->name('get-akun-by-platform');

// Untuk Daftar Arsip: Ambil akun berdasarkan nama_platform (bukan ID)
Route::get('/get-akun-by-platform-nama/{nama_platform}', [AkunPlatformController::class, 'getByPlatformName']);

/*
|--------------------------------------------------------------------------
| Guest Routes (tanpa login)
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect('/home'));
Route::get('/home', fn() => view('home'));
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Routes with Middleware 'auth' (hanya bisa diakses setelah login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->group(function () {
        Route::get('/menu', [MenuController::class, 'menuAdmin'])->name('admin.menu-admin');

        // Kelola Operator
        Route::get('/daftar-operator', [UserController::class, 'index'])->name('admin.daftar-operator');
        Route::get('/tambah-operator', [UserController::class, 'create'])->name('admin.tambah-operator');
        Route::post('/tambah-operator', [UserController::class, 'store'])->name('users.store');
        Route::get('/edit-operator/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/edit-operator/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/hapus-operator/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        // Kelola Platform
        Route::get('/daftar-platform', [PlatformController::class, 'index'])->name('admin.daftar-platform');
        Route::get('/tambah-platform', [PlatformController::class, 'create'])->name('admin.tambah-platform');
        Route::post('/tambah-platform', [PlatformController::class, 'store'])->name('platform.store');
        Route::get('/edit-platform/{id}', [PlatformController::class, 'edit'])->name('platform.edit');
        Route::put('/edit-platform/{id}', [PlatformController::class, 'update'])->name('platform.update');
        Route::delete('/hapus-platform/{id}', [PlatformController::class, 'destroy'])->name('platform.destroy');

        // Kelola Akun Platform
        Route::get('/daftar-akun', [AkunPlatformController::class, 'index'])->name('admin.daftar-akun-platform');
        Route::get('/tambah-akun', [AkunPlatformController::class, 'create'])->name('admin.tambah-akun');
        Route::post('/tambah-akun', [AkunPlatformController::class, 'store'])->name('akun-platform.store');
        Route::get('/edit-akun/{id}', [AkunPlatformController::class, 'edit'])->name('akun-platform.edit');
        Route::put('/edit-akun/{id}', [AkunPlatformController::class, 'update'])->name('akun-platform.update');
        Route::delete('/hapus-akun/{id}', [AkunPlatformController::class, 'destroy'])->name('akun-platform.destroy');

        // Arsip Konten
        Route::get('/arsip-konten', [ArsipKontenController::class, 'index'])->name('admin.daftar-arsip');
        Route::get('/arsip-konten/tambah', [ArsipKontenController::class, 'create'])->name('arsip-konten.create');
        Route::post('/arsip-konten/tambah', [ArsipKontenController::class, 'store'])->name('arsip-konten.store');
        Route::get('/arsip-konten/edit/{id}', [ArsipKontenController::class, 'edit'])->name('arsip-konten.edit');
        Route::put('/arsip-konten/edit/{id}', [ArsipKontenController::class, 'update'])->name('arsip-konten.update');
        Route::delete('/arsip-konten/hapus/{id}', [ArsipKontenController::class, 'destroy'])->name('arsip-konten.destroy');
        Route::get('/arsip-konten/{id}/grafik', [ArsipKontenController::class, 'grafikPerArsip'])->name('arsip.grafik');

        // Kelola Tema
        Route::get('/daftar-tema', [TemaKontenController::class, 'index'])->name('admin.daftar-tema');
        Route::get('/tema/create', [TemaKontenController::class, 'create'])->name('admin.tambah-tema');
        Route::post('/tema/store', [TemaKontenController::class, 'store'])->name('admin.tema.store');
        Route::get('/tema/{id}/edit', [TemaKontenController::class, 'edit'])->name('admin.edit-tema');
        Route::put('/tema/{id}', [TemaKontenController::class, 'update'])->name('admin.update-tema');
        Route::delete('/tema/{id}', [TemaKontenController::class, 'destroy'])->name('admin.hapus-tema');

        // Cetak
        Route::get('/arsip-konten/cetak-pdf', [ArsipCetakController::class, 'cetakPDF'])->name('arsip.cetak.pdf');
        Route::get('/arsip-konten/cetak-word', [ArsipCetakController::class, 'cetakWord'])->name('arsip.cetak.word');
    });

    /*
    |--------------------------------------------------------------------------
    | OPERATOR ROUTES
    |--------------------------------------------------------------------------
    */
    Route::prefix('operator')->group(function () {
        Route::get('/menu', fn() => view('operator.menu-operator'))->name('operator.menu');

        // Arsip Konten
        Route::get('/arsip-konten', [ArsipKontenController::class, 'index'])->name('operator.daftar-arsip');
        Route::get('/arsip-konten/tambah', [ArsipKontenController::class, 'create'])->name('operator.arsip.create');
        Route::post('/arsip-konten/tambah', [ArsipKontenController::class, 'store'])->name('operator.arsip.store');
        Route::get('/arsip-konten/edit/{id}', [ArsipKontenController::class, 'edit'])->name('operator.arsip.edit');
        Route::put('/arsip-konten/edit/{id}', [ArsipKontenController::class, 'update'])->name('operator.arsip.update');
        Route::delete('/arsip-konten/hapus/{id}', [ArsipKontenController::class, 'destroy'])->name('operator.arsip.destroy');
        Route::get('/arsip-konten/{id}/grafik', [ArsipKontenController::class, 'grafikPerArsip'])->name('operator.arsip.grafik');

        // Cetak
        Route::get('/arsip-konten/cetak-pdf', [ArsipCetakController::class, 'cetakPDF'])->name('operator.arsip.cetak.pdf');
        Route::get('/arsip-konten/cetak-word', [ArsipCetakController::class, 'cetakWord'])->name('operator.arsip.cetak.word');
    });

});
