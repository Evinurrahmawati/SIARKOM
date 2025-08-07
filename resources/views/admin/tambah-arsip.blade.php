<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Arsip</title>
  <link rel="stylesheet" href="{{ asset('css/style-tambaharsip.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery for AJAX -->
</head>
<body>

  <div class="container">
    <div class="logo-container">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    </div>

    <h2>Tambah Arsip Konten</h2>

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

    <form method="POST" action="{{ route('arsip-konten.store') }}" enctype="multipart/form-data">
      @csrf

      <!-- Platform -->
      <div>
        <label for="id_platform">Pilih Platform</label>
        <select name="id_platform" id="id_platform" required>
          <option value="">-- Pilih Platform --</option>
          @foreach ($platforms as $platform)
            <option value="{{ $platform->id_platform }}">{{ $platform->nama_platform }}</option>
          @endforeach
        </select>
      </div>

      <!-- Akun akan terisi otomatis -->
      <div>
        <label for="id_akun">Pilih Akun</label>
        <select name="id_akun" id="id_akun" required>
          <option value="">-- Pilih Akun --</option>
        </select>
      </div>

      <!-- Tema -->
      <div>
        <label for="id_tema">Pilih Tema</label>
        <select name="id_tema" id="id_tema" required>
          <option value="">-- Pilih Tema --</option>
          @foreach ($temas as $tema)
            <option value="{{ $tema->id_tema }}">{{ $tema->nama_tema }}</option>
          @endforeach
        </select>
      </div>

      <!-- Judul -->
      <div>
        <label for="judul">Judul</label>
        <input type="text" name="judul" id="judul" required>
      </div>

      <!-- Tanggal -->
      <div>
        <label for="tanggal">Tanggal</label>
        <input type="date" name="tanggal" id="tanggal" required>
      </div>

      <!-- Jam -->
      <div>
        <label for="jam">Jam</label>
        <input type="text" name="jam" id="jam" required>
      </div>

      <!-- Like -->
      <div>
        <label for="like">Jumlah Like</label>
        <input type="number" name="like" id="like" placeholder="Masukkan jumlah like">
      </div>

      <!-- View -->
      <div>
        <label for="view">Jumlah View</label>
        <input type="number" name="view" id="view" placeholder="Masukkan jumlah view">
      </div>
      
      <!-- Gambar -->
      <div>
        <label for="gambar">Upload Gambar</label>
        <input type="file" name="gambar" id="gambar" accept="image/*" required>
      </div>

      <div class="tombol-container">
        <a href="{{ route('admin.daftar-arsip') }}" class="btn-kembali">← Kembali ke Daftar</a>
        <button type="submit"><i class="fas fa-save"></i> Simpan Arsip</button>
      </div>
    </form>
  </div>

  <!-- Time Picker -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    flatpickr("#jam", {
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i",
      time_24hr: true
    });
  </script>

  <!-- AJAX: Muat Akun Berdasarkan Platform -->
  <script>
    $('#id_platform').on('change', function () {
      const platformId = $(this).val();
      const akunSelect = $('#id_akun');
      akunSelect.empty().append('<option>Loading...</option>');

      if (platformId) {
        $.ajax({
          url: `/get-akun-by-platform/${platformId}`,
          method: 'GET',
          success: function (data) {
            akunSelect.empty().append('<option value="">-- Pilih Akun --</option>');
            $.each(data, function (i, akun) {
              akunSelect.append(`<option value="${akun.id_akun}">${akun.nama_akun}</option>`);
            });
          },
          error: function () {
            akunSelect.html('<option value="">Gagal memuat akun</option>');
          }
        });
      } else {
        akunSelect.html('<option value="">-- Pilih Akun --</option>');
      }
    });
  </script>

</body>
</html>
