<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemaKonten;

class TemaKontenController extends Controller
{
    // =============================
    // 1. Tampilkan Semua Tema
    // =============================
    public function index()
    {
        $temas = TemaKonten::all();
        return view('admin.daftar-tema', compact('temas'));
    }

    // =============================
    // 2. Form Tambah Tema
    // =============================
    public function create()
    {
        return view('admin.tambah-tema');
    }

    // =============================
    // 3. Simpan Tema Baru
    // =============================
    public function store(Request $request)
    {
        $request->validate([
            'nama_tema' => 'required|max:100'
        ]);

        TemaKonten::create([
            'nama_tema' => $request->nama_tema
        ]);

        return redirect()->route('admin.daftar-tema')->with('success', 'Topik berhasil ditambahkan.');
    }

    // =============================
    // 4. Form Edit Tema
    // =============================
    public function edit($id_tema)
    {
        $tema = TemaKonten::findOrFail($id_tema);
        return view('admin.edit-tema', compact('tema'));
    }

    // =============================
    // 5. Update Tema
    // =============================
    public function update(Request $request, $id_tema)
    {
        $request->validate([
            'nama_tema' => 'required|max:100'
        ]);

        $tema = TemaKonten::findOrFail($id_tema);
        $tema->update([
            'nama_tema' => $request->nama_tema
        ]);

        return redirect()->route('admin.daftar-tema')->with('success', 'Topik berhasil diperbarui.');
    }

    // =============================
    // 6. Hapus Tema
    // =============================
    public function destroy($id_tema)
    {
        $tema = TemaKonten::findOrFail($id_tema);
        $tema->delete();

        return redirect()->route('admin.daftar-tema')->with('success', 'Topik berhasil dihapus.');
    }
}
