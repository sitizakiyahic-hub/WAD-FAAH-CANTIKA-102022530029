<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alamat Pengiriman</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f2ff; margin: 0; padding: 30px; color: #333; }
        .container { max-width: 1200px; margin: auto; }
        h1 { color: #6c4ab6; }
        .card { background: white; padding: 24px; border-radius: 12px; box-shadow: 0 3px 10px #ddd; margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; vertical-align: top; }
        th { background: #7856c9; color: white; }
        .btn, .btn-edit { display: inline-block; padding: 8px 14px; background: #7856c9; color: white; border-radius: 6px; text-decoration: none; }
        .btn-edit { padding: 7px 12px; border-radius: 5px; white-space: nowrap; }
        .message { background: #e4f8e8; padding: 12px; border-radius: 6px; }
        label { display: block; margin-top: 14px; margin-bottom: 6px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 6px; font-family: Arial, sans-serif; }
        textarea { min-height: 90px; resize: vertical; }
        .btn-tambah { margin-top: 18px; padding: 10px 16px; background: #7856c9; color: white; border: none; border-radius: 6px; cursor: pointer; }
        .error { color: #c62828; background: #ffeaea; padding: 10px; border-radius: 6px; }
        .table-wrapper { overflow-x: auto; }
        .btn-hapus { background: #dc3545; color: white; padding: 7px 12px; border: none; border-radius: 5px; cursor: pointer; white-space: nowrap; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Alamat Pengiriman</h1>
        <p>Pengelolaan daftar alamat pengiriman pelanggan</p>

        @if (session('success'))
            <p class="message">{{ session('success') }}</p>
        @endif

        <div class="card">
            <h2>Data Alamat</h2>
            <h3>Tambah Alamat Pengiriman</h3>

            @if ($errors->any())
                <div class="error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('alamat.store') }}" method="POST">
                @csrf

                <label for="pelanggan_id">Nama Pelanggan</label>
                <select name="pelanggan_id" id="pelanggan_id" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach ($pelanggan as $data)
                        <option value="{{ $data->id }}" {{ old('pelanggan_id') == $data->id ? 'selected' : '' }}>
                            {{ $data->nama }}
                        </option>
                    @endforeach
                </select>

                <label for="label">Label Alamat</label>
                <input type="text" name="label" id="label" value="{{ old('label') }}" placeholder="Contoh: Rumah atau Kantor" required>

                <label for="alamat">Alamat Lengkap</label>
                <textarea name="alamat" id="alamat" required>{{ old('alamat') }}</textarea>

                <label for="kota">Kota</label>
                <input type="text" name="kota" id="kota" value="{{ old('kota') }}" required>

                <label for="provinsi">Provinsi</label>
                <input type="text" name="provinsi" id="provinsi" value="{{ old('provinsi') }}" required>

                <label for="kode_pos">Kode Pos</label>
                <input type="text" name="kode_pos" id="kode_pos" value="{{ old('kode_pos') }}" required>

                <label for="status">Status</label>
                <select name="status" id="status" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>

                <button type="submit" class="btn-tambah">Simpan Alamat</button>
            </form>

            <h3>Daftar Alamat Pengiriman</h3>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Label</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>Provinsi</th>
                            <th>Kode Pos</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($alamat as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ optional($pelanggan->firstWhere('id', $data->pelanggan_id))->nama ?? 'Pelanggan tidak ditemukan' }}</td>
                                <td>{{ $data->label }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->kota }}</td>
                                <td>{{ $data->provinsi }}</td>
                                <td>{{ $data->kode_pos }}</td>
                                <td>{{ $data->status }}</td>
                                <td>
                                    <a class="btn-edit" href="{{ route('alamat.edit', $data->id) }}">Edit</a>
                                    <form action="{{ route('alamat.destroy', $data->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus alamat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-hapus">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">Belum ada data alamat pengiriman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <p>Jumlah alamat: <strong>{{ $alamat->count() }}</strong></p>

            <a class="btn" href="{{ route('pelanggan.index') }}">Kembali ke Daftar Pelanggan</a>
        </div>
    </div>
</body>
</html>