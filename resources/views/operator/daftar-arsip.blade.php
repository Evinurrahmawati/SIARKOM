<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Arsip Konten</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style-arsip.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
  <button class="sidebar-toggle-btn" onclick="toggleSidebar()">☰ Menu</button>

  <div class="container">
    <!-- Header -->
    <div class="header">
      <div class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" />
        <span>Arsip Konten Media Sosial dan Website</span>
      </div>

      <div class="user-info">
        <div class="greeting">Hi, {{ auth()->user()->role == 'admin' ? 'Admin' : 'Operator' }}</div>
        <div class="profile-dropdown">
          <img src="{{ asset('images/foto.png') }}" alt="Profil" class="profile-img" onclick="toggleDropdown()" />
          <div class="dropdown-menu" id="profileDropdown">
            <p>{{ auth()->user()->name }}</p>
            <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div class="content">
      <!-- Sidebar -->
      <nav class="sidebar">
        <ul>
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('operator.daftar-arsip') }}" class="{{ Request::routeIs('operator.daftar-arsip') ? 'active' : '' }}">
                        <i class="fas fa-folder-open"></i> Lihat Arsip
                    </a>
                </li>
                <li>
                    <a href="{{ route('operator.arsip.create') }}" class="{{ Request::routeIs('operator.arsip.create') ? 'active' : '' }}">
                        <i class="fas fa-upload"></i> Upload
                    </a>
                </li>
            </ul>
      </nav>

      <!-- Main -->
      <main class="main-content">
        <!-- Filter + Tambah -->
        <div class="filter-and-action">
          <form method="GET" action="{{ route('operator.daftar-arsip') }}" class="filter-bar">
            @php
              use Carbon\Carbon;
              \Carbon\Carbon::setLocale('id');
              $bulanList = [
                '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
              ];
            @endphp

            <select name="bulan_dari">
              <option value="">Dari Bulan</option>
              @foreach ($bulanList as $key => $value)
                <option value="{{ $key }}" {{ request('bulan_dari') == $key ? 'selected' : '' }}>{{ $value }}</option>
              @endforeach
            </select>

            <select name="bulan_sampai">
              <option value="">Sampai Bulan</option>
              @foreach ($bulanList as $key => $value)
                <option value="{{ $key }}" {{ request('bulan_sampai') == $key ? 'selected' : '' }}>{{ $value }}</option>
              @endforeach
            </select>

            <select name="tahun">
              <option value="">Tahun</option>
              @foreach ($tahunList as $thn)
                <option value="{{ $thn }}" {{ request('tahun') == $thn ? 'selected' : '' }}>{{ $thn }}</option>
              @endforeach
            </select>

            <select name="platform" id="platformFilter">
              <option value="">Platform</option>
              @foreach ($platforms as $platform)
                <option value="{{ $platform->nama_platform }}" {{ request('platform') == $platform->nama_platform ? 'selected' : '' }}>
                  {{ $platform->nama_platform }}
                </option>
              @endforeach
            </select>

            <select name="akun" id="akunFilter">
              <option value="">Nama Akun</option>
              @foreach ($akun_platforms as $akun)
                <option value="{{ $akun->nama_akun }}" {{ request('akun') == $akun->nama_akun ? 'selected' : '' }}>
                  {{ $akun->nama_akun }}
                </option>
              @endforeach
            </select>

            <select name="tema">
              <option value="">Topik</option>
              @foreach ($temas as $tema)
                <option value="{{ $tema->nama_tema }}" {{ request('tema') == $tema->nama_tema ? 'selected' : '' }}>
                  {{ $tema->nama_tema }}
                </option>
              @endforeach
            </select>

            <input type="text" name="search" placeholder="Search platform" value="{{ request('search') }}" />

            <button type="submit" class="btn-cetak">Filter</button>

            <a href="{{ route('operator.daftar-arsip') }}" class="btn-reset" title="Reset Filter">
              <i class="fas fa-arrows-rotate"></i>
            </a>
          </form>

          <div class="add-container">
            <a href="{{ route('operator.arsip.create') }}">
              <button class="add-button">+ Tambah</button>
            </a>
          </div>
        </div>

        <!-- Cetak PDF -->
        <div class="export-buttons">
          <a href="{{ route('operator.arsip.cetak.pdf', request()->all()) }}" class="btn-cetak" target="_blank">
            <i class="fas fa-file-pdf"></i> Cetak PDF
          </a>
        </div>
  
        <!-- Flash -->
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif 

        <!-- Tabel -->
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Akun</th>
              <th>Platform</th>
              <th>Judul</th>
              <th>Topik</th> <!-- Tambahan -->
              <th>Tanggal</th>
              <th>Jam</th>
              <th>Gambar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($arsips as $index => $arsip)
              <tr>
                <td>{{ ($arsips->currentPage() - 1) * $arsips->perPage() + $index + 1 }}</td>
                <td>{{ $arsip->akun->nama_akun ?? '-' }}</td>
                <td>{{ $arsip->platform->nama_platform ?? '-' }}</td>
                <td>{{ $arsip->judul }}</td>
                <td>{{ $arsip->tema->nama_tema ?? '-' }}</td> <!-- Tambahan -->
                <td>{{ \Carbon\Carbon::parse($arsip->tanggal)->translatedFormat('d F Y') }}</td>
                <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $arsip->jam)->format('H:i') }}</td>
                <td>
                  @if ($arsip->gambar)
                    <img src="{{ asset('storage/' . $arsip->gambar) }}" alt="Gambar" />
                  @else
                    -
                  @endif
                </td>
                <td>
                  <div class="action-buttons">
                    <a href="{{ route('operator.arsip.edit', $arsip->id) }}" class="edit-btn" title="Edit"><i class="fas fa-edit"></i></a>
                    <a href="{{ route('operator.arsip.grafik', $arsip->id) }}" class="grafik-btn" title="Lihat Grafik"><i class="fas fa-chart-pie"></i></a>
                    <form action="{{ route('operator.arsip.destroy', $arsip->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                      @csrf
                      @method('DELETE')
                      <button class="delete-btn" title="Hapus"><i class="fas fa-trash"></i></button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr><td colspan="9">Data tidak ditemukan.</td></tr>
            @endforelse
          </tbody>
        </table>

         <!-- Pagination dan Jumlah Data -->
        <div class="pagination-wrapper">
          <div class="jumlah-data">
            Jumlah: {{ $arsips->total() }} data
          </div>

          <div class="pagination-container">
            @if ($arsips->hasPages())
              <ul class="pagination">
                {{-- Previous --}}
                @if ($arsips->onFirstPage())
                  <li class="disabled"><span><i class="fas fa-chevron-left"></i></span></li>
                @else
                  <li><a href="{{ $arsips->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a></li>
                @endif

                {{-- Pages --}}
                @foreach ($arsips->getUrlRange(1, $arsips->lastPage()) as $page => $url)
                  @if ($page == $arsips->currentPage())
                    <li class="active"><span>{{ $page }}</span></li>
                  @else
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                  @endif
                @endforeach

                {{-- Next --}}
                @if ($arsips->hasMorePages())
                  <li><a href="{{ $arsips->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a></li>
                @else
                  <li class="disabled"><span><i class="fas fa-chevron-right"></i></span></li>
                @endif
              </ul>
            @endif
          </div>
        </div>
      </main>
    </div>
  </div>

  <script>
    function toggleSidebar() {
      document.querySelector('.sidebar').classList.toggle('active');
    }
  </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script>
        $('#platformFilter').on('change', function () {
          const platformNama = $(this).val();
          $('#akunFilter').html('<option value="">Memuat akun...</option>');

          if (platformNama) {
            $.ajax({
              url: `/get-akun-by-platform-nama/${platformNama}`,
              type: 'GET',
              success: function (response) {
                let akunOptions = '<option value="">Nama Akun</option>';
                response.forEach(function (akun) {
                  akunOptions += `<option value="${akun.nama_akun}">${akun.nama_akun}</option>`;
                });
                $('#akunFilter').html(akunOptions);
              },
              error: function () {
                $('#akunFilter').html('<option value="">Gagal memuat akun</option>');
              }
            });
          } else {
            $('#akunFilter').html('<option value="">Nama Akun</option>');
          }
        });
      </script>

      <script>
        function toggleDropdown() {
          document.getElementById("profileDropdown").classList.toggle("show");
        }

        // Tutup dropdown jika klik di luar
        window.onclick = function (e) {
          if (!e.target.matches('.profile-img')) {
            var dropdowns = document.getElementsByClassName("dropdown-menu");
            for (let i = 0; i < dropdowns.length; i++) {
              let openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
              }
            }
          }
        }
      </script>

      <script>
  // Auto-dismiss flash message after 3 seconds
  document.addEventListener("DOMContentLoaded", function () {
    const alert = document.querySelector(".alert.alert-success");
    if (alert) {
      setTimeout(() => {
        alert.style.transition = "opacity 0.5s ease";
        alert.style.opacity = "0";
        setTimeout(() => alert.remove(), 500); // Remove after fade out
      }, 3000); // 3000ms = 3 detik
    }
  });
</script>

</body>
</html>
