<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Menu Admin - Dinas Kominfo Lampung</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-menu-admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
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
                <img src="{{ asset('images/profil.png') }}" alt="Profile" class="profile-img" onclick="toggleProfileMenu()" />
                <div class="dropdown-menu" id="profileMenu">
                <p>{{ Auth::user()->name }}</p>
                <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>

    </header>

    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="{{ route('dashboard') }}" class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="{{ route('admin.daftar-arsip') }}" class="{{ Request::routeIs('admin.daftar-arsip') ? 'active' : '' }}">
                    <i class="fas fa-folder-open"></i> Lihat Arsip</a></li>
                <li><a href="{{ route('arsip-konten.create') }}" class="{{ Request::routeIs('arsip-konten.create') ? 'active' : '' }}">
                    <i class="fas fa-upload"></i> Upload</a></li>
                <li><a href="{{ route('admin.daftar-platform') }}" class="{{ Request::routeIs('admin.daftar-platform') ? 'active' : '' }}">
                    <i class="fas fa-cogs"></i> Kelola Platform</a></li>
                <li><a href="{{ route('admin.daftar-akun-platform') }}" class="{{ Request::routeIs('admin.daftar-akun-platform') ? 'active' : '' }}">
                    <i class="fas fa-user-cog"></i> Kelola Akun Platform</a></li>
                <li><a href="{{ route('admin.daftar-tema') }}" class="{{ Request::routeIs('admin.daftar-tema') ? 'active' : '' }}">
                    <i class="fas fa-folder-open"></i> Kelola Topik</a></li>
                <li><a href="{{ route('admin.daftar-operator') }}" class="{{ Request::routeIs('admin.daftar-operator') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Kelola Pengguna</a></li>
            </ul>
        </nav>

        <main class="content">
            <div class="date-display">
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>

            <div class="stats-grid">
                <div class="stat-card bg-blue">
                    <div class="info">
                        <h1>{{ $jumlahArsip ?? 0 }}</h1>
                        <p>Jumlah Postingan</p>
                    </div>
                    <i class="fas fa-file-alt icon"></i>
                </div>
                <div class="stat-card bg-green">
                    <div class="info">
                        <h1>{{ $jumlahPlatform ?? 0 }}</h1>
                        <p>Jumlah Platform</p>
                    </div>
                    <i class="fas fa-cogs icon"></i>
                </div>
                <div class="stat-card bg-orange">
                    <div class="info">
                        <h1>{{ $jumlahAkunPlatform ?? 0 }}</h1>
                        <p>Jumlah Akun Platform</p>
                    </div>
                    <i class="fas fa-user icon"></i>
                </div>
                <div class="stat-card bg-purple">
                    <div class="info">
                        <h1>{{ $jumlahHalaman ?? 0 }}</h1>
                        <p>Jumlah Page</p>
                    </div>
                    <i class="fas fa-file icon"></i>
                </div>
                <div class="stat-card bg-pink">
                    <div class="info">
                        <h1>{{ $jumlahTopik ?? 0 }}</h1>
                        <p>Jumlah Topik</p>
                    </div>
                    <i class="fas fa-tags icon"></i>
                </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }

        function toggleProfileMenu() {
            document.getElementById('profileMenu').classList.toggle('show');
        }

        // Klik di luar untuk menutup menu
        window.addEventListener('click', function(e) {
            if (!e.target.closest('.profile-dropdown')) {
                document.getElementById('profileMenu')?.classList.remove('show');
            }
        });
    </script>

</body>
</html>
