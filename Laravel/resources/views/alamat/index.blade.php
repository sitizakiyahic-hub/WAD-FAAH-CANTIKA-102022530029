<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alamat Pengiriman</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; color: #333; }
        input, select { padding: 9px; margin: 5px 0; box-sizing: border-box; }
        .btn, button { display: inline-block; padding: 8px 12px; background: #2563eb; color: white; text-decoration: none; border: 0; cursor: pointer; border-radius: 4px; }
        .hapus { background: #dc2626; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 9px; text-align: left; }
        th { background: #f3f4f6; }
        .pesan { color: green; }
        .form-tambah { padding: 15px; background: #f9fafb; border: 1px solid #ddd; }
        .form-tambah label { display: block; margin-top: 10px; }
        .form-tambah input, .form-tambah select { width: 100%; max-width: 500px; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Alamat Pengiriman</h1>

    <p>
        <a href="{{ route('pelanggan.index') }}" class="btn">Data Pelanggan</a>
    </p>

    @if (session('success'))
        <p class="pesan">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <ul class="error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h2>Cari Alamat</h2>

    <form action="{{ route('alamat.index') }}" method="GET">
        <input type="text" name="cari"
               placeholder="Cari label, alamat, kota, atau pelanggan..."
               value="{{ $cari ?? '' }}">

        <button type="submit">Cari</button>
        <a href="{{ route('alamat.index') }}">Reset</a>
    </form>

    <hr>

    <h2>Tambah Alamat</h2>

    <div class="form-tambah">
        <form action="{{ route('alamat.store') }}" method="POST">
            @csrf

            <label>Pelanggan</label>
            <select name="pelanggan_id" required>
                <option value="">Pilih Pelanggan</option>
                @foreach ($pelanggan as $orang)
                    <option value="{{ $orang->id }}"
                        {{ old('pelanggan_id') == $orang->id ? 'selected' : '' }}>
                        {{ $orang->nama }}
                    </option>
                @endforeach
            </select>

            <label>Label Alamat</label>
            <input type="text" name="label" value="{{ old('label') }}"
                   placeholder="Contoh: Rumah" required>

            <label>Alamat Lengkap</label>
            <input type="text" name="alamat" value="{{ old('alamat') }}"
                   placeholder="Masukkan alamat lengkap" required>

            <label>Kota</label>
            <input type="text" name="kota" value="{{ old('kota') }}" required>

            <label>Provinsi</label>
            <input type="text" name="provinsi" value="{{ old('provinsi') }}" required>

            <label>Kode Pos</label>
            <input type="text" name="kode_pos" value="{{ old('kode_pos') }}" required>

            <label>Status</label>
            <select name="status" required>
                <option value="">Pilih Status</option>
                <option value="Utama" {{ old('status') == 'Utama' ? 'selected' : '' }}>Utama</option>
                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>

            <br>
            <button type="submit" style="margin-top: 15px;">Simpan Alamat</button>
        </form>
    </div>

    <h2>Daftar Alamat</h2>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Pelanggan</th>
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
            @forelse ($alamat as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $pelanggan->firstWhere('id', $item->pelanggan_id)?->nama ?? 'Pelanggan tidak ditemukan' }}
                    </td>
                    <td>{{ $item->label }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->kota }}</td>
                    <td>{{ $item->provinsi }}</td>
                    <td>{{ $item->kode_pos }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <a href="{{ route('alamat.edit', $item->id) }}">Edit</a>

                        <form action="{{ route('alamat.destroy', $item->id) }}"
                              method="POST"
                              style="display:inline"
                              onsubmit="return confirm('Yakin ingin menghapus alamat ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Belum ada alamat pengiriman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
