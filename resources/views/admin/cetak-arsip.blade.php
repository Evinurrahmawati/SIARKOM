<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan {{ $platform ?? 'Platform' }}</title>
    <style>
        body {
            font-family: Calibri, sans-serif;
            padding: 30px;
            font-size: 11px;
            color: #000;
        }

        .judul-utama {
            text-align: center;
            font-weight: bold;
            font-size: 15px;
            margin-bottom: 2px;
        }

        .subjudul {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            width: 25%;
            vertical-align: top;
            padding: 5px;
            page-break-inside: avoid;
        }

        .item-date {
            font-weight: bold;
            font-size: 10px;
            text-align: center;
            margin-bottom: 5px;
            min-height: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .item-caption {
            font-size: 9px;
            text-align: center;
            margin-bottom: 6px;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1.3;
        }

        img {
            width: 100%;
            max-width: 180px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #ccc;
            display: block;
            margin: 0 auto;
        }

        .no-image {
            width: 100%;
            height: 140px;
            background: #eee;
            display: flex;
            justify-content: center;
            align-items: center;
            font-style: italic;
            color: #999;
            border-radius: 5px;
            margin-bottom: 6px;
        }

        .footer-count {
            margin-top: 30px;
            font-size: 12px;
            font-weight: bold;
            text-align: left;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

@php
    use Carbon\Carbon;
@endphp

@foreach ($arsips as $bulanKey => $listArsip)
    @php
        $carbonBulan = Carbon::createFromFormat('Y-m', $bulanKey);
        $bulanNama = $carbonBulan->translatedFormat('F');
        $tahunTeks = $carbonBulan->year;
        $platformTeks = $platform ?? '-';
        $akunTeks = $akun ?? '-';
        $rows = array_chunk($listArsip->all(), 3);
    @endphp

    <div class="judul-utama">{{ $bulanNama }} {{ $tahunTeks }}</div>
    <div class="subjudul">Laporan {{ $platformTeks }} &#64;{{ $akunTeks }}</div>

    <table>
        @foreach ($rows as $row)
            <tr>
                @foreach ($row as $arsip)
                    <td>
                        <div class="item-date">
                            {{ Carbon::parse($arsip->tanggal)->translatedFormat('d F Y') }}<br>
                            {{ Carbon::createFromFormat('H:i:s', $arsip->jam)->format('H.i') }} WIB
                        </div>
                        <div class="item-caption">
                            {!! nl2br(e(\Illuminate\Support\Str::limit($arsip->judul, 250))) !!}
                        </div>
                        @php $gambarPath = public_path('storage/' . $arsip->gambar); @endphp
                        @if ($arsip->gambar && file_exists($gambarPath))
                            <img src="{{ $gambarPath }}" alt="Gambar">
                        @else
                            <div class="no-image">[Gambar Tidak Tersedia]</div>
                        @endif
                    </td>
                @endforeach
                @for ($i = count($row); $i < 3; $i++)
                    <td></td>
                @endfor
            </tr>
        @endforeach
    </table>

    <div class="footer-count">
        Jumlah Postingan: {{ $listArsip->count() }}
    </div>

    @if (!$loop->last)
        <div class="page-break"></div>
    @endif

@endforeach

</body>
</html>
