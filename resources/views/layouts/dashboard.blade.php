<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Dashboard')</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style-dashboard.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
  <video autoplay muted loop id="bg-video">
    <source src="{{ asset('images/bg1.mp4') }}" type="video/mp4">
    Browser Anda tidak mendukung video.
  </video>

  <div class="main-content-overlay">
    <div class="welcome-container">
      <h1 class="welcome-text typing-effect">Selamat Datang di Aplikasi SIARKOM</h1>
      @yield('content')
    </div>
  </div>
</body>
</html>
