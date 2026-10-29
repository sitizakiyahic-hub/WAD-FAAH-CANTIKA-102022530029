<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Alamat Pengiriman</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        label { display: block; margin-top: 15px; }
        input, select { width: 100%; max-width: 500px; padding: 9px; margin-top: 5px; box-sizing: border-box; }
        button { margin-top: 20px; padding: 10px 15px; background: #2563eb; color: white; border: 0; cursor: pointer; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Edit Alamat Pengiriman</h1>

    @if ($errors->any())
        <ul class="error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('alamat.update', $alamat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Pelanggan</label>
        <select name="pelanggan_id" required>
            @foreach ($pelanggan as $orang)
                <option value="{{ $orang->id }}"
                    {{ old('pelanggan_id', $alamat->pelanggan_id) == $orang->id ? 'selected' : '' }}>
                    {{ $orang->nama }}
                </option>
            @endforeach
        </select>

        <label>Label Alamat</label>
        <input type="text" name="label"
               value="{{ old('label', $alamat->label) }}" required>

        <label>Alamat Lengkap</label>
        <input type="text" name="alamat"
               value="{{ old('alamat', $alamat->alamat) }}" required>

        <label>Kota</label>
        <input type="text" name="kota"
               value="{{ old('kota', $alamat->kota) }}" required>

        <label>Provinsi</label>
        <input type="text" name="provinsi"
               value="{{ old('provinsi', $alamat->provinsi) }}" required>

        <label>Kode Pos</label>
        <input type="text" name="kode_pos"
               value="{{ old('kode_pos', $alamat->kode_pos) }}" required>

        <label>Status</label>
        <select name="status" required>
            @foreach (['Utama', 'Aktif', 'Nonaktif'] as $status)
                <option value="{{ $status }}"
                    {{ old('status', $alamat->status) == $status ? 'selected' : '' }}>
                    {{ $status }}
                </option>
            @endforeach
        </select>

        <br>
        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('alamat.index') }}">Batal</a>
    </form>
</body>
</html>
