<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-login.css') }}">
</head>
<body>
    <!-- Video Background -->
    <video autoplay muted loop id="bg-video">
        <source src="{{ asset('images/bg video.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Overlay -->
    <div class="overlay">
        <!-- Topbar -->
        <div class="topbar">
            <div class="logo-text">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Kominfo">
                <div class="text">
                    <strong>Sistem Informasi Pengelolaan dan Pengarsipan Konten Media Sosial dan Website</strong><br>
                    Dinas Komunikasi Informatika dan Statistik Provinsi Lampung
                </div>
            </div>
            <a href="{{ route('login') }}" class="login-button">Login</a>
        </div>
    </div>
</body>
</html>
