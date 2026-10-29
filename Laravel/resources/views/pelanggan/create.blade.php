<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f2ff; margin: 0; padding: 30px; color: #333; }
        .container { max-width: 650px; margin: auto; }
        h1 { color: #6c4ab6; }
        .card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 3px 10px #ddd; }
        label { display: block; margin-top: 16px; margin-bottom: 7px; font-weight: bold; }
        input, select { width: 100%; padding: 11px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 6px; }
        .btn { display: inline-block; padding: 11px 16px; border: none; border-radius: 6px; background: #7856c9; color: white; text-decoration: none; cursor: pointer; margin-top: 20px; }
        .back { background: #777; margin-left: 5px; }
        .error { color: #c62828; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Pelanggan</h1>
        <p>Silakan isi data pelanggan baru.</p>

        <div class="card">
            <form action="{{ route('pelanggan.store') }}" method="POST">
                @csrf

                <label for="nama">Nama Pelanggan</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>
                @error('nama')<p class="error">{{ $message }}</p>@enderror

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')<p class="error">{{ $message }}</p>@enderror

                <label for="no_hp">Nomor HP</label>
                <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required>
                @error('no_hp')<p class="error">{{ $message }}</p>@enderror

                <label for="member">Member</label>
                <select id="member" name="member" required>
                    <option value="">-- Pilih Member --</option>
                    <option value="Gold" {{ old('member') == 'Gold' ? 'selected' : '' }}>Gold</option>
                    <option value="Platinum" {{ old('member') == 'Platinum' ? 'selected' : '' }}>Platinum</option>
                    <option value="Silver" {{ old('member') == 'Silver' ? 'selected' : '' }}>Silver</option>
                </select>
                @error('member')<p class="error">{{ $message }}</p>@enderror

                <button type="submit" class="btn">Simpan Pelanggan</button>
                <a href="{{ route('pelanggan.index') }}" class="btn back">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>