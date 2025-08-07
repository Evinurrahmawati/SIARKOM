<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Tema</title>
  <link rel="stylesheet" href="{{ asset('css/style-tambahoperator.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <div class="container">
    <div class="logo-container">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    </div>

    <h2>Edit Topik Konten</h2>

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

    <form method="POST" action="{{ route('admin.update-tema', $tema->id_tema) }}">
      @csrf
      @method('PUT')

      <div>
        <label for="nama_tema">Nama Topik</label>
        <input type="text" name="nama_tema" id="nama_tema" value="{{ $tema->nama_tema }}" required>
      </div>

      <div class="tombol-container">
        <a href="{{ route('admin.daftar-tema') }}" class="btn-kembali">← Kembali ke Daftar</a>
        <button type="submit"><i class="fas fa-save"></i> Simpan Perubahan</button>
      </div>
      
    </form>
  </div>

</body>
</html>
