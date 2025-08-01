<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Operator</title>
    <link rel="stylesheet" href="{{ asset('css/style-tambahoperator.css') }}">
</head>
<body>

<div class="container">
    <div class="logo-container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    </div>

    <h2>Edit Data Operator</h2>

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

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <label for="name">Nama</label>
        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>

        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>

        <label for="password">Password (biarkan kosong jika tidak diubah)</label>
        <input type="password" name="password" id="password">

        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation">

        <button type="submit">Simpan Perubahan</button>
    </form>
</div>

</body>
</html>
