<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Platform</title>
    <link rel="stylesheet" href="{{ asset('css/style-tambahoperator.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="container">
    <div class="logo-container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    </div>

    <h2>Edit Data Platform</h2>

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

    <form method="POST" action="{{ route('platform.update', $platform->id_platform) }}">
        @csrf
        @method('PUT')

        <label for="nama_platform">Nama Platform</label>
        <input type="text" name="nama_platform" id="nama_platform" value="{{ old('nama_platform', $platform->nama_platform) }}" required>

        <div class="tombol-container">
        <a href="{{ route('admin.daftar-platform') }}" class="btn-kembali">← Kembali ke Daftar</a>
        <button type="submit"><i class="fas fa-save"></i> Simpan Perubahan</button>
        </div>
        
    </form>
</div>

</body>
</html>
