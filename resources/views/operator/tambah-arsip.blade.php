<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Arsip (Operator)</title>
  <link rel="stylesheet" href="{{ asset('css/style-tambaharsip.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

  <div class="container">
    <div class="logo-container">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    </div>

    <h2>Tambah Arsip Konten</h2>

    @if(session('success'))
      <div class="alert">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
      <div class="alert alert-error">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('operator.arsip.store') }}" enctype="multipart/form-data">
      @csrf

      <div>
        <label for="id_platform">Pilih Platform</label>
        <select name="id_platform" id="id_platform" required>
          <option value="">-- Pilih Platform --</option>
          @foreach ($platforms as $platform)
            <option value="{{ $platform->id_platform }}" {{ old('id_platform') == $platform->id_platform ? 'selected' : '' }}>
              {{ $platform->nama_platform }}
            </option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="id_akun">Pilih Akun</label>
        <select name="id_akun" id="id_akun" required>
          <option value="">-- Pilih Akun --</option>
          @foreach ($akun_platforms as $akun)
            <option value="{{ $akun->id_akun }}" {{ old('id_akun') == $akun->id_akun ? 'selected' : '' }}>
              {{ $akun->nama_akun }}
            </option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="id_tema">Pilih Tema</label>
        <select name="id_tema" id="id_tema" required>
          <option value="">-- Pilih Tema --</option>
          @foreach ($temas as $tema)
            <option value="{{ $tema->id_tema }}" {{ old('id_tema') == $tema->id_tema ? 'selected' : '' }}>
              {{ $tema->nama_tema }}
            </option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="judul">Judul</label>
        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required>
      </div>

      <div>
        <label for="tanggal">Tanggal</label>
        <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" required>
      </div>

      <div>
        <label for="jam">Jam</label>
        <input type="text" name="jam" id="jam" value="{{ old('jam') }}" required>
      </div>

      <div>
        <label for="like">Jumlah Like</label>
        <input type="number" name="like" id="like" value="{{ old('like') }}">
      </div>

      <div>
        <label for="view">Jumlah View</label>
        <input type="number" name="view" id="view" value="{{ old('view') }}">
      </div>
      
      <div>
        <label for="gambar">Upload Gambar</label>
        <input type="file" name="gambar" id="gambar" accept="image/*" required>
      </div>

      <div class="tombol-container">
        <a href="{{ route('operator.daftar-arsip') }}" class="btn-kembali">← Kembali ke Daftar</a>
        <button type="submit"><i class="fas fa-save"></i> Simpan Arsip</button>
      </div>
      
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    flatpickr("#jam", {
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i",
      time_24hr: true
    });

    // Update daftar akun saat platform berubah
    $('#id_platform').on('change', function () {
      const platformId = $(this).val();
      const akunSelect = $('#id_akun');
      akunSelect.empty().append('<option value="">-- Pilih Akun --</option>');

      if (platformId) {
        $.get(`/get-akun-by-platform/${platformId}`, function (data) {
          if (data.length > 0) {
            data.forEach(akun => {
              akunSelect.append(`<option value="${akun.id_akun}">${akun.nama_akun}</option>`);
            });
          }
        });
      }
    });
  </script>

</body>
</html>
