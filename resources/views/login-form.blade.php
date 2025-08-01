<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style-formlogin.css') }}">
</head>
<body>

  <!-- Background Video -->
  <video autoplay muted loop id="bgVideo">
    <source src="{{ asset('images/bg video.mp4') }}" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <!-- Overlay Konten -->
  <div class="main-content-overlay">
    <div class="container">

      <!-- Kiri: Logo & Selamat Datang -->
      <div class="left-side">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img" />
        <h1 id="typing-text"></h1>
        <p>Login untuk mulai mengelola dan mengarsipkan data dengan efisien</p>
      </div>

      <!-- Kanan: Form Login -->
      <div class="right-side">
        <form method="POST" action="{{ route('login') }}" class="login-form">
          @csrf
          <h2>Login</h2>

          @if(session('error'))
            <div class="alert-error">
              {{ session('error') }}
            </div>
          @endif

          <div class="input-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required autofocus>
          </div>

          <div class="input-group">
            <label for="password">Kata Sandi</label>
            <input type="password" id="password" name="password" required>
          </div>

          <button type="submit">Masuk</button>
        </form>
      </div>

    </div>
  </div>

  <!-- Efek Mengetik -->
  <script>
    const text = "Silakan Login";
    const target = document.getElementById("typing-text");
    let index = 0;

    function typeEffect() {
      if (index < text.length) {
        target.innerHTML = text.substring(0, index + 1) + "<span class='cursor'>|</span>";
        index++;
        setTimeout(typeEffect, 100);
      } else {
        document.querySelector(".cursor").remove();
      }
    }

    document.addEventListener("DOMContentLoaded", typeEffect);
  </script>

</body>
</html>
