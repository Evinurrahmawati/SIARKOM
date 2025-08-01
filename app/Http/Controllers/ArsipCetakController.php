<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipKonten;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ArsipCetakController extends Controller
{
    public function cetakPdf(Request $request)
{
    $tahun       = $request->tahun;
    $platform    = $request->platform;
    $akun        = $request->akun;
    $bulanDari   = $request->bulan_dari;
    $bulanSampai = $request->bulan_sampai;

    $arsips = ArsipKonten::with(['platform', 'akun'])
        ->when($tahun, fn($q) => $q->whereYear('tanggal', $tahun))
        ->when($bulanDari && $bulanSampai, function ($q) use ($bulanDari, $bulanSampai) {
            $q->whereMonth('tanggal', '>=', $bulanDari)
              ->whereMonth('tanggal', '<=', $bulanSampai);
        })
        ->when($platform, fn($q) =>
            $q->whereHas('platform', fn($p) => $p->where('nama_platform', $platform)))
        ->when($akun, fn($q) =>
            $q->whereHas('akun', fn($a) => $a->where('nama_akun', $akun)))
        ->orderBy('tanggal')
        ->orderBy('jam')
        ->get()
        ->groupBy(fn($arsip) => Carbon::parse($arsip->tanggal)->format('Y-m'));

    $view = auth()->user()->role === 'operator'
        ? 'operator.cetak-arsip'
        : 'admin.cetak-arsip';

    $pdf = Pdf::loadView($view, [
        'arsips'   => $arsips,
        'tahun'    => $tahun,
        'platform' => $platform,
        'akun'     => $akun
    ])->setPaper('A4', 'portrait');

    $filename = 'Laporan_' . str_replace(' ', '_', $platform) . '_' . str_replace(' ', '_', $akun) . "_{$tahun}.pdf";

    return $pdf->download($filename);
}

}
