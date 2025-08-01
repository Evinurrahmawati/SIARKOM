<?php

namespace App\Http\Controllers;

use App\Models\AkunPlatform;
use App\Models\Platform;
use Illuminate\Http\Request;

class AkunPlatformController extends Controller
{
    // ✅ Menampilkan daftar akun
    public function index()
    {
        $akun_platforms = AkunPlatform::with('platform')->get();
        return view('admin.daftar-akun-platform', compact('akun_platforms'));
    }

    // ✅ Menampilkan form tambah akun
    public function create()
    {
        $platforms = Platform::all();
        return view('admin.tambah-akun', compact('platforms'));
    }

    // ✅ Menyimpan akun baru
    public function store(Request $request)
    {
        $request->validate([
            'id_platform' => 'required|exists:platform,id_platform',
            'nama_akun'   => 'required|string|max:100',
        ]);

        AkunPlatform::create([
            'id_platform' => $request->id_platform,
            'nama_akun'   => $request->nama_akun,
        ]);

        return redirect()
            ->route('admin.daftar-akun-platform')
            ->with('success', 'Akun platform berhasil ditambahkan!');
    }

    // ✅ Menampilkan form edit akun
    public function edit($id)
    {
        $akun = AkunPlatform::where('id_akun', $id)->firstOrFail();
        $platforms = Platform::all();
        return view('admin.edit-akun', compact('akun', 'platforms'));
    }

    // ✅ Memperbarui data akun
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_platform' => 'required|exists:platform,id_platform',
            'nama_akun'   => 'required|string|max:100',
        ]);

        $akun = AkunPlatform::where('id_akun', $id)->firstOrFail();
        $akun->update([
            'id_platform' => $request->id_platform,
            'nama_akun'   => $request->nama_akun,
        ]);

        return redirect()
            ->route('admin.daftar-akun-platform')
            ->with('success', 'Akun platform berhasil diperbarui!');
    }

    // ✅ Menghapus akun
    public function destroy($id)
    {
        $akun = AkunPlatform::where('id_akun', $id)->firstOrFail();
        $akun->delete();

        return redirect()
            ->route('admin.daftar-akun-platform')
            ->with('success', 'Akun platform berhasil dihapus!');
    }

    // ✅ Method untuk AJAX: ambil akun berdasarkan platform
    public function getByPlatform($id)
        {
            $akunList = AkunPlatform::where('id_platform', $id)->get();

            return response()->json($akunList);
        }
    
    public function getByPlatformName($nama_platform)
        {
            $platform = \App\Models\Platform::where('nama_platform', $nama_platform)->first();

            if (!$platform) {
                return response()->json([]);
            }

            $akuns = \App\Models\AkunPlatform::where('id_platform', $platform->id_platform)->get(['id_akun', 'nama_akun']);
            return response()->json($akuns);
        }

    
    }