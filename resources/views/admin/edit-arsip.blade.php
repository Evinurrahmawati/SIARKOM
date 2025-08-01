<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Arsip</title>
  <link rel="stylesheet" href="{{ asset('css/style-tambaharsip.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

  <div class="container">
    <div class="logo-container">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    </div>

    <h2>Edit Arsip Konten</h2>

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

    <form method="POST" action="{{ route('arsip-konten.update', $arsip->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <!-- Platform -->
      <div>
        <label for="id_platform">Pilih Platform</label>
        <select name="id_platform" id="id_platform" required>
          <option value="">-- Pilih Platform --</option>
          @foreach ($platforms as $platform)
            <option value="{{ $platform->id_platform }}" {{ $arsip->id_platform == $platform->id_platform ? 'selected' : '' }}>
              {{ $platform->nama_platform }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- Akun -->
      <div>
        <label for="id_akun">Pilih Akun</label>
        <select name="id_akun" id="id_akun" required>
          <option value="">-- Pilih Akun --</option>
          @foreach ($akun_platforms as $akun)
            @if ($akun->id_platform == $arsip->id_platform)
              <option value="{{ $akun->id_akun }}" {{ $arsip->id_akun == $akun->id_akun ? 'selected' : '' }}>
                {{ $akun->nama_akun }}
              </option>
            @endif
          @endforeach
        </select>
      </div>

      <!-- Tema -->
      <div>
        <label for="id_tema">Pilih Tema</label>
        <select name="id_tema" id="id_tema" required>
          <option value="">-- Pilih Tema --</option>
          @foreach ($temas as $tema)
            <option value="{{ $tema->id_tema }}" {{ $arsip->id_tema == $tema->id_tema ? 'selected' : '' }}>
              {{ $tema->nama_tema }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- Judul -->
      <div>
        <label for="judul">Judul</label>
        <input type="text" name="judul" id="judul" value="{{ old('judul', $arsip->judul) }}" required>
      </div>

      <!-- Tanggal -->
      <div>
        <label for="tanggal">Tanggal</label>
        <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $arsip->tanggal) }}" required>
      </div>

      <!-- Jam -->
      <div>
        <label for="jam">Jam</label>
        <input type="text" name="jam" id="jam" value="{{ old('jam', \Carbon\Carbon::createFromFormat('H:i:s', $arsip->jam)->format('H:i')) }}" required>
      </div>

      <!-- Like -->
      <div>
        <label for="like">Jumlah Like</label>
        <input type="number" name="like" id="like" value="{{ old('like', $arsip->like ?? 0) }}">
      </div>

      <!-- View -->
      <div>
        <label for="view">Jumlah View</label>
        <input type="number" name="view" id="view" value="{{ old('view', $arsip->view ?? 0) }}">
      </div>

      <!-- Gambar -->
      <div>
        <label for="gambar">Upload Gambar Baru</label>
        <input type="file" name="gambar" id="gambar" accept="image/*">
        @if ($arsip->gambar)
          <p>Gambar saat ini:</p>
          <img src="{{ asset('storage/' . $arsip->gambar) }}" alt="Gambar" style="max-width: 120px;">
        @endif
      </div>

      <button type="submit"><i class="fas fa-save"></i> Update Arsip</button>
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
