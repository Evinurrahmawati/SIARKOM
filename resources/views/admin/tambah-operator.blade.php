<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Operator</title>
  <link rel="stylesheet" href="{{ asset('css/style-tambahoperator.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <div class="container">
    <div class="logo-container">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    </div>

    <h2>Tambah Operator Baru</h2>

    {{-- Pesan sukses --}}
    @if(session('success'))
      <div class="alert">{{ session('success') }}</div>
    @endif

    {{-- Pesan error validasi --}}
    @if ($errors->any())
      <div class="alert alert-error">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('users.store') }}">
      @csrf

      <div>
        <label for="name">Nama</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
      </div>

      <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="{{ old('username') }}" required>
      </div>

      <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
      </div>

      <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
      </div>

      <div>
        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
      </div>

      <div class="tombol-container">
        <a href="{{ route('admin.daftar-operator') }}" class="btn-kembali">← Kembali ke Daftar</a>
        <button type="submit"><i class="fas fa-user-plus"></i> Tambah Operator</button>
      </div>
      
    </form>
  </div>

</body>
</html>
