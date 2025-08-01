<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    // Tampilkan semua platform
    public function index()
    {
        $platforms = Platform::all();
        return view('admin.daftar-platform', compact('platforms'));
    }

    // Tampilkan form tambah platform
    public function create()
    {
        return view('admin.tambah-platform');
    }

    // Simpan platform baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_platform' => 'required|max:100'
        ]);

        Platform::create($request->only('nama_platform'));

        return redirect()->route('admin.daftar-platform')->with('success', 'Platform berhasil ditambahkan!');
    }

    // Tampilkan form edit platform
    public function edit($id)
    {
        $platform = Platform::where('id_platform', $id)->firstOrFail();
        return view('admin.edit-platform', compact('platform'));
    }

    // Simpan perubahan platform
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_platform' => 'required|max:100'
        ]);

        $platform = Platform::where('id_platform', $id)->firstOrFail();
        $platform->update($request->only('nama_platform'));

        return redirect()->route('admin.daftar-platform')->with('success', 'Platform berhasil diperbarui!');
    }

    // Hapus platform
    public function destroy($id)
    {
        $platform = Platform::where('id_platform', $id)->firstOrFail();
        $platform->delete();

        return redirect()->route('admin.daftar-platform')->with('success', 'Platform berhasil dihapus.');
    }
}
