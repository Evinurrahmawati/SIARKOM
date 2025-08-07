<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daftar Akun Platform</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style-daftar-operator.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>

  <button class="sidebar-toggle-btn" onclick="toggleSidebar()">☰ Menu</button>

  <div class="container">
    <!-- Header -->
    <div class="header">
      <div class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" />
        <span>DAFTAR AKUN PLATFORM</span>
      </div>

      <div class="user-info">
        <div class="greeting">Hi, {{ auth()->user()->role == 'admin' ? 'Admin' : 'Operator' }}</div>
        <div class="profile-dropdown">
          <img src="{{ asset('images/profil.png') }}" alt="Profil" class="profile-img" onclick="toggleDropdown()" />
          <div class="dropdown-menu" id="profileDropdown">
            <p>{{ auth()->user()->name }}</p>
            <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bar Data -->
    <div class="datauser-bar">
      <span class="datauser-title">Data Akun</span>
      <div class="search-wrapper">
        <input class="search-box" id="search-box" type="text" placeholder="Cari nama akun..." />
      </div>
    </div>

    <div class="content">
      <!-- Sidebar -->
      <nav class="sidebar">
        <ul>
          <li>
            <a href="{{ route('dashboard') }}" class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
              <i class="fas fa-home"></i> Dahboard
            </a>
          </li>
          <li>
            <a href="{{ route('admin.daftar-arsip') }}" class="{{ Request::routeIs('admin.daftar-arsip') ? 'active' : '' }}">
              <i class="fas fa-folder-open"></i> Lihat Arsip
            </a>
          </li>
          <li>
            <a href="{{ route('arsip-konten.create') }}" class="{{ Request::routeIs('arsip-konten.create') ? 'active' : '' }}">
              <i class="fas fa-upload"></i> Upload
            </a>
          </li>
          <li>
            <a href="{{ route('admin.daftar-platform') }}" class="{{ Request::routeIs('admin.daftar-platform') ? 'active' : '' }}">
              <i class="fas fa-cogs"></i> Kelola Platform
            </a>
          </li>
          <li>
            <a href="{{ route('admin.daftar-akun-platform') }}" class="{{ Request::routeIs('admin.daftar-akun-platform') ? 'active' : '' }}">
              <i class="fas fa-user-cog"></i> Kelola Akun Platform
            </a>
          </li>
          <li>
            <a href="{{ route('admin.daftar-tema') }}" class="{{ Request::routeIs('admin.daftar-tema') ? 'active' : '' }}">
              <i class="fas fa-folder-open"></i> Kelola Topik
            </a>
          </li>
          <li>
            <a href="{{ route('admin.daftar-operator') }}" class="{{ Request::routeIs('admin.daftar-operator') ? 'active' : '' }}">
              <i class="fas fa-users"></i> Kelola Pengguna
            </a>
          </li>
        </ul>
      </nav>

      <!-- Main Content -->
      <main class="main-content">
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="button-below-search">
          <a href="{{ route('admin.tambah-akun') }}">
            <button class="add-user-button">+ Tambah Akun</button>
          </a>
        </div>

        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Platform</th>
              <th>Nama Akun</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="akun-table-body">
            @foreach ($akun_platforms as $akun)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ optional($akun->platform)->nama_platform ?? '-' }}</td>
                <td>{{ $akun->nama_akun }}</td>
                <td>
                  <a href="{{ route('akun-platform.edit', $akun->id_akun) }}" class="edit-btn" title="Edit">
                    <i class="fas fa-edit"></i>
                  </a>
                  <form action="{{ route('akun-platform.destroy', $akun->id_akun) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button class="delete-btn" title="Hapus" onclick="return confirm('Yakin ingin menghapus akun ini?')">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>


        <div class="jumlah">
          Jumlah Akun: <span id="jumlah-akun">{{ count($akun_platforms) }}</span>
        </div>
      </main>
    </div>
  </div>

  <script>
    function toggleSidebar() {
      document.querySelector('.sidebar').classList.toggle('active');
    }

    function toggleDropdown() {
      const dropdown = document.getElementById('profileDropdown');
      dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }

    // Tutup dropdown jika klik di luar
    window.addEventListener('click', function(e) {
      const dropdown = document.getElementById('profileDropdown');
      const img = document.querySelector('.profile-img');
      if (!dropdown.contains(e.target) && !img.contains(e.target)) {
        dropdown.style.display = 'none';
      }
    });

    document.addEventListener("DOMContentLoaded", function () {
      const searchBox = document.getElementById("search-box");
      const rows = document.querySelectorAll("#akun-table-body tr");
      const jumlahSpan = document.getElementById("jumlah-akun");

      searchBox.addEventListener("keyup", function () {
        const keyword = this.value.toLowerCase();
        let visibleCount = 0;

        rows.forEach(row => {
          const namaAkun = row.cells[2].textContent.toLowerCase();
          if (namaAkun.includes(keyword)) {
            row.style.display = "";
            visibleCount++;
          } else {
            row.style.display = "none";
          }
        });

        jumlahSpan.textContent = visibleCount;
      });
    });
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
