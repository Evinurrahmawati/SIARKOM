<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daftar Operator</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style-daftar-operator.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>

  <!-- Tombol toggle sidebar untuk layar kecil -->
  <button class="sidebar-toggle-btn" onclick="toggleSidebar()">☰ Menu</button>

  <div class="container">
    <!-- Header -->
    <div class="header">
      <div class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" />
        <span>Daftar Operator</span>
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

    <!-- Bar Data User -->
    <div class="datauser-bar">
      <span class="datauser-title">Data User</span>
      <div class="search-wrapper">
        <input class="search-box" id="search-box" type="text" placeholder="Cari nama, username, atau email..." />
      </div>
    </div>

    <!-- Sidebar dan Konten -->
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
          </li>
        </ul>
      </nav>

      <!-- Main Content -->
      <main class="main-content">
        {{-- Pesan sukses --}}
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

         <div class="button-below-search">
          <a href="{{ route('admin.tambah-operator') }}">
            <button class="add-user-button">+ Tambah Operator</button>
          </a>
        </div>
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Username</th> <!-- Kolom baru -->
              <th>Email</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="user-table-body">
            @php $no = 1; @endphp
            @foreach ($users as $user)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td> <!-- Kolom username -->
                <td>{{ $user->email }}</td>
                <td>
                  <a href="{{ route('users.edit', $user->id) }}" class="edit-btn" title="Edit">
                    <i class="fas fa-edit"></i>
                  </a>
                  <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button class="delete-btn" title="Hapus" onclick="return confirm('Yakin ingin menghapus operator ini?')">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <div class="jumlah">
          Jumlah: <span id="jumlah-user">{{ count($users) }}</span>
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


    // Fungsi pencarian dengan tambahan pencarian username
    document.getElementById("search-box").addEventListener("keyup", function () {
      const keyword = this.value.toLowerCase();
      const rows = document.querySelectorAll("#user-table-body tr");

      rows.forEach((row) => {
        const name = row.cells[1].textContent.toLowerCase();
        const username = row.cells[2].textContent.toLowerCase();
        const email = row.cells[3].textContent.toLowerCase();

        if (name.includes(keyword) || username.includes(keyword) || email.includes(keyword)) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      });

      const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
      document.getElementById("jumlah-user").textContent = visibleRows.length;
    });
  </script>

</body>
</html>
