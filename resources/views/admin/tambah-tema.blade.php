<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Topik</title>
  <link rel="stylesheet" href="{{ asset('css/style-tambahoperator.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <div class="container">
    <div class="logo-container">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    </div>

    <h2>Tambah Topik Konten</h2>

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

    <form method="POST" action="{{ route('admin.tema.store') }}">
      @csrf

      <div>
        <label for="nama_tema">Nama Topik</label>
        <input type="text" name="nama_tema" id="nama_tema" required placeholder="Contoh: Ekonomi, Pendidikan">
      </div>

      <button type="submit"><i class="fas fa-plus-circle"></i> Tambah Topik</button>
    </form>
  </div>

</body>
</html>
