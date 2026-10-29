<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        label { display: block; margin-top: 15px; }
        input, select { width: 100%; max-width: 450px; padding: 9px; margin-top: 5px; box-sizing: border-box; }
        button { margin-top: 20px; padding: 10px 15px; background: #2563eb; color: white; border: 0; cursor: pointer; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Tambah Pelanggan</h1>

    @if ($errors->any())
        <ul class="error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf

        <label>Nama</label>
        <input type="text" name="nama" value="{{ old('nama') }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>No. HP</label>
        <input type="text" name="no_hp" value="{{ old('no_hp') }}" required>

        <label>Member</label>
        <select name="member" required>
            <option value="">Pilih Member</option>
            <option value="Gold">Gold</option>
            <option value="Platinum">Platinum</option>
            <option value="Silver">Silver</option>
        </select>

        <button type="submit">Simpan</button>
        <a href="{{ route('pelanggan.index') }}">Batal</a>
    </form>
</body>
</html>
