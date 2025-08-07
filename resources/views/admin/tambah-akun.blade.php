<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Akun Platform</title>
  <link rel="stylesheet" href="{{ asset('css/style-tambahoperator.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <div class="container">
    <div class="logo-container">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    </div>

    <h2>Tambah Akun Platform</h2>

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

    <form method="POST" action="{{ route('akun-platform.store') }}">
      @csrf

      <div>
        <label for="id_platform">Pilih Platform</label>
        <select name="id_platform" id="id_platform" required>
          <option value="">-- Pilih Platform --</option>
          @foreach ($platforms as $platform)
            <option value="{{ $platform->id_platform }}">{{ $platform->nama_platform }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="nama_akun">Nama Akun</label>
        <input type="text" name="nama_akun" id="nama_akun" required>
      </div>

      <div class="tombol-container">
        <a href="{{ route('admin.daftar-akun-platform') }}" class="btn-kembali">← Kembali ke Daftar</a>
        <button type="submit"><i class="fas fa-plus-circle"></i> Tambah Akun</button>
        </div>
    </form>
  </div>

</body>
</html>
