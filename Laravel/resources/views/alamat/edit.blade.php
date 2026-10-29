<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Alamat Pengiriman</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f0ff; padding: 30px; }
        .container { max-width: 600px; margin: auto; background: white; padding: 25px; border-radius: 12px; }
        h2 { color: #7856c9; }
        label { display: block; margin-top: 14px; margin-bottom: 6px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 6px; font-family: Arial, sans-serif; }
        textarea { min-height: 90px; }
        button { margin-top: 20px; padding: 10px 16px; background: #7856c9; color: white; border: none; border-radius: 6px; cursor: pointer; }
        a { color: #7856c9; }
        .error { color: #c62828; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Alamat Pengiriman</h2>

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

            <label>Nama Pelanggan</label>
            <select name="pelanggan_id" required>
                @foreach ($pelanggan as $data)
                    <option value="{{ $data->id }}" {{ old('pelanggan_id', $alamat->pelanggan_id) == $data->id ? 'selected' : '' }}>
                        {{ $data->nama }}
                    </option>
                @endforeach
            </select>

            <label>Label Alamat</label>
            <input type="text" name="label" value="{{ old('label', $alamat->label) }}" required>

            <label>Alamat Lengkap</label>
            <textarea name="alamat" required>{{ old('alamat', $alamat->alamat) }}</textarea>

            <label>Kota</label>
            <input type="text" name="kota" value="{{ old('kota', $alamat->kota) }}" required>

            <label>Provinsi</label>
            <input type="text" name="provinsi" value="{{ old('provinsi', $alamat->provinsi) }}" required>

            <label>Kode Pos</label>
            <input type="text" name="kode_pos" value="{{ old('kode_pos', $alamat->kode_pos) }}" required>

            <label>Status</label>
            <select name="status" required>
                <option value="Aktif" {{ old('status', $alamat->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Tidak Aktif" {{ old('status', $alamat->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>

            <button type="submit">Simpan Perubahan</button>
        </form>

        <p><a href="{{ route('alamat.index') }}">Kembali ke Daftar Alamat</a></p>
    </div>
</body>
</html>