<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Menu Operator - Dinas Kominfo Lampung</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style-menu-admin.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

  <style>

    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }

    .container {
      min-height: 100vh;
      display: flex;
    }

    .content {
      background: url("{{ asset('images/bg.jpg') }}") no-repeat center center;
      background-size: cover;
      width: 100%;
      min-height: calc(100vh - 100px); /* Tinggi penuh dikurangi header */
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
    }

    @media (max-width: 768px) {
      .header, .title h1, .title h2 {
        text-align: center;
      }

      .content {
        background-size: contain;
        padding: 20px;
        min-height: 60vh;
        position: relative;
        z-index: 1;

      }

      .sidebar {
        background-color: #2f6baa;
        color: white;
        padding: 10px;
        z-index: 2;
}
    }
  </style>
</head>
<body>

  <button class="sidebar-toggle-btn" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
  </button>

  <header class="header">
    <img src="{{ asset('images/logo.png') }}" alt="Logo Dinas Kominfo Lampung" class="logo">
    <div class="title">
      <h1>Sistem Informasi Pengelolaan dan Pengarsipan Konten</h1>
      <h2>Dinas Komunikasi Informatika dan Statistik Provinsi Lampung</h2>
    </div>

    <div class="user-info">
      <span class="greeting">Hi, {{ Auth::user()->role == 'admin' ? 'Admin' : 'Operator' }}</span>
      <div class="profile-dropdown">
        <img src="{{ asset('images/foto.png') }}" alt="Profile" class="profile-img" onclick="toggleProfileMenu()" />
        <div class="dropdown-menu" id="profileMenu">
          <p>{{ Auth::user()->name }}</p>
          <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </div>
    </div>
  </header>

  <div class="container">
    <aside class="sidebar">
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
          <a href="{{ route('arsip-konten.create') }}" class="{{ Request::routeIs('arsip-konten.create') ? 'active' : '' }}">
            <i class="fas fa-upload"></i> Upload
          </a>
        </li>
      </ul>
    </aside>

    <!-- Konten utama -->
    <main class="content">
      <!-- Konten bisa ditambahkan di sini -->
    </main>
  </div>

  <script>
    function toggleSidebar() {
      document.querySelector('.sidebar').classList.toggle('active');
    }

    function toggleProfileMenu() {
      document.getElementById('profileMenu').classList.toggle('show');
    }

    window.addEventListener('click', function(e) {
      if (!e.target.closest('.profile-dropdown')) {
        document.getElementById('profileMenu')?.classList.remove('show');
      }
    });
  </script>

</body>
</html>
