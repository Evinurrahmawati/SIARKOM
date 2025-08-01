<?php

namespace App\Http\Controllers;

use App\Models\ArsipKonten;
use App\Models\Platform;
use App\Models\AkunPlatform;
use App\Models\TemaKonten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipKontenController extends Controller
{
    public function index(Request $request)
        {
            $user = auth()->user();

            // Ambil input filter tahun dan bulan
            $tahun = $request->tahun;
            $bulanDari = $request->bulan_dari;
            $bulanSampai = $request->bulan_sampai;

            $arsips = ArsipKonten::with('platform', 'akun', 'tema')

                // Filter berdasarkan rentang bulan dalam tahun yang sama
                ->when($tahun && $bulanDari && $bulanSampai, function ($q) use ($tahun, $bulanDari, $bulanSampai) {
                    $tanggalAwal = "$tahun-$bulanDari-01";
                    $tanggalAkhir = date("Y-m-t", strtotime("$tahun-$bulanSampai-01"));
                    $q->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
                })

                // Jika hanya bulan dari yang dipilih
                ->when($tahun && $bulanDari && !$bulanSampai, function ($q) use ($tahun, $bulanDari) {
                    $tanggalAwal = "$tahun-$bulanDari-01";
                    $tanggalAkhir = date("Y-m-t", strtotime($tanggalAwal));
                    $q->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
                })

                // Jika hanya bulan sampai yang dipilih
                ->when($tahun && !$bulanDari && $bulanSampai, function ($q) use ($tahun, $bulanSampai) {
                    $tanggalAwal = "$tahun-$bulanSampai-01";
                    $tanggalAkhir = date("Y-m-t", strtotime($tanggalAwal));
                    $q->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
                })

                // ✅ Tambahkan ini agar filter tahun saja juga berfungsi
                ->when($tahun && !$bulanDari && !$bulanSampai, function ($q) use ($tahun) {
                    $tanggalAwal = "$tahun-01-01";
                    $tanggalAkhir = "$tahun-12-31";
                    $q->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
                })

                // Filter lainnya
                ->when($request->platform, fn($q) =>
                    $q->whereHas('platform', fn($p) => $p->where('nama_platform', $request->platform)))
                ->when($request->akun, fn($q) =>
                    $q->whereHas('akun', fn($a) => $a->where('nama_akun', $request->akun)))
                ->when($request->tema, fn($q) =>
                    $q->whereHas('tema', fn($t) => $t->where('nama_tema', $request->tema)))
                ->when($request->search, function ($q) use ($request) {
                    $q->where(function ($sub) use ($request) {
                        $sub->where('judul', 'like', '%' . $request->search . '%')
                            ->orWhereHas('platform', fn($p) =>
                                $p->where('nama_platform', 'like', '%' . $request->search . '%'));
                    });
                })
                ->latest()
                ->paginate(10)
                ->appends($request->query());

            // Ambil data untuk filter
            $platforms = Platform::all();
            $akun_platforms = AkunPlatform::all();
            $temas = TemaKonten::all();
            $tahunList = ArsipKonten::selectRaw('YEAR(tanggal) as tahun')
                ->distinct()
                ->orderByDesc('tahun')
                ->pluck('tahun');

            // Tentukan view berdasarkan role
            $role = strtolower($user->role);
            $view = $role === 'admin' ? 'admin.daftar-arsip' : 'operator.daftar-arsip';

            return view($view, compact('arsips', 'platforms', 'akun_platforms', 'temas', 'tahunList'));
        }


    public function create()
    {
        $platforms = Platform::all();
        $akun_platforms = AkunPlatform::all();
        $temas = TemaKonten::all();

        $role = strtolower(auth()->user()->role);
        $view = $role === 'admin' ? 'admin.tambah-arsip' : 'operator.tambah-arsip';

        return view($view, compact('platforms', 'akun_platforms', 'temas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_platform' => 'required|exists:platform,id_platform',
            'id_akun'     => 'required|exists:akun_platform,id_akun',
            'id_tema'     => 'required|exists:tema_konten,id_tema',
            'judul'       => 'required|max:255',
            'tanggal'     => 'required|date',
            'jam'         => 'required',
            'gambar'      => 'nullable|image|max:2048',
            'like'        => 'nullable|integer|min:0',
            'view'        => 'nullable|integer|min:0',
        ]);

        $gambarPath = $request->hasFile('gambar')
            ? $request->file('gambar')->store('arsip', 'public')
            : null;

        ArsipKonten::create([
            'id_platform' => $request->id_platform,
            'id_akun'     => $request->id_akun,
            'id_tema'     => $request->id_tema,
            'judul'       => $request->judul,
            'tanggal'     => $request->tanggal,
            'jam'         => $request->jam,
            'gambar'      => $gambarPath,
            'like'        => $request->like,
            'view'        => $request->view,
        ]);

        $role = strtolower(auth()->user()->role);
        $route = $role === 'admin' ? 'admin.daftar-arsip' : 'operator.daftar-arsip';
        return redirect()->route($route)->with('success', 'Arsip berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $arsip = ArsipKonten::findOrFail($id);
        $platforms = Platform::all();
        $akun_platforms = AkunPlatform::all();
        $temas = TemaKonten::all();

        $role = strtolower(auth()->user()->role);
        $view = $role === 'admin' ? 'admin.edit-arsip' : 'operator.edit-arsip';

        return view($view, compact('arsip', 'platforms', 'akun_platforms', 'temas'));
    }

    public function update(Request $request, $id)
    {
        $arsip = ArsipKonten::findOrFail($id);

        $request->validate([
            'id_platform' => 'required|exists:platform,id_platform',
            'id_akun'     => 'required|exists:akun_platform,id_akun',
            'id_tema'     => 'required|exists:tema_konten,id_tema',
            'judul'       => 'required|max:255',
            'tanggal'     => 'required|date',
            'jam'         => 'required',
            'gambar'      => 'nullable|image|max:2048',
            'like'        => 'nullable|integer|min:0',
            'view'        => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('gambar')) {
            if ($arsip->gambar) {
                Storage::disk('public')->delete($arsip->gambar);
            }
            $arsip->gambar = $request->file('gambar')->store('arsip', 'public');
        }

        $arsip->update([
            'id_platform' => $request->id_platform,
            'id_akun'     => $request->id_akun,
            'id_tema'     => $request->id_tema,
            'judul'       => $request->judul,
            'tanggal'     => $request->tanggal,
            'jam'         => $request->jam,
            'gambar'      => $arsip->gambar,
            'like'        => $request->like,
            'view'        => $request->view,
        ]);

        $role = strtolower(auth()->user()->role);
        $route = $role === 'admin' ? 'admin.daftar-arsip' : 'operator.daftar-arsip';
        return redirect()->route($route)->with('success', 'Arsip berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $arsip = ArsipKonten::findOrFail($id);

        if ($arsip->gambar) {
            Storage::disk('public')->delete($arsip->gambar);
        }

        $arsip->delete();

        $role = strtolower(auth()->user()->role);
        $route = $role === 'admin' ? 'admin.daftar-arsip' : 'operator.daftar-arsip';
        return redirect()->route($route)->with('success', 'Arsip berhasil dihapus.');
    }

    public function grafikPerArsip($id)
    {
        $user = auth()->user();

        $arsip = ArsipKonten::with('platform', 'akun', 'tema')->findOrFail($id);

        $statistik = [
            'Like' => $arsip->like ?? 0,
            'View' => $arsip->view ?? 0,
        ];

        $role = strtolower($user->role);
        $view = $role === 'admin' ? 'admin.grafik-like-view' : 'operator.grafik-like-view';

        return view($view, compact('arsip', 'statistik'));
    }
}
