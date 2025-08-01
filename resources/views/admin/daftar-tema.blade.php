<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daftar Topik</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style-daftar-operator.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>

  <!-- Tombol toggle sidebar -->
  <button class="sidebar-toggle-btn" onclick="toggleSidebar()">☰ Menu</button>

  <div class="container">
    <!-- Header -->
    <div class="header">
      <div class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" />
        <span>Daftar Topik </span>
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
      <span class="datauser-title">Data Topik</span>
      <div class="search-wrapper">
        <input class="search-box" id="search-box" type="text" placeholder="Cari nama topik..." />
      </div>
    </div>

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
          <a href="{{ route('admin.tambah-tema') }}">
            <button class="add-user-button">+ Tambah Topik</button>
          </a>
        </div>


        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Topik</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="tema-table-body">
            @foreach ($temas as $tema)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $tema->nama_tema }}</td>
                <td>
                  <a href="{{ route('admin.edit-tema', $tema->id_tema) }}" class="edit-btn" title="Edit">
                    <i class="fas fa-edit"></i>
                  </a>
                  <form action="{{ route('admin.hapus-tema', $tema->id_tema) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button class="delete-btn" title="Hapus" onclick="return confirm('Yakin ingin menghapus topik ini?')">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>


        <div class="jumlah">
          Jumlah Topik: <span id="jumlah-tema">{{ count($temas) }}</span>
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

    document.getElementById("search-box").addEventListener("keyup", function () {
      const keyword = this.value.toLowerCase();
      const rows = document.querySelectorAll("#tema-table-body tr");

      let visibleCount = 0;
      rows.forEach((row) => {
        const nama = row.cells[1].textContent.toLowerCase();
        if (nama.includes(keyword)) {
          row.style.display = "";
          visibleCount++;
        } else {
          row.style.display = "none";
        }
      });

      document.getElementById("jumlah-topik").textContent = visibleCount;
    });
  </script>

</body>
</html>
