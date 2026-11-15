<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Alamat Pengiriman</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <h1>Edit Alamat Pengiriman</h1>

    <div class="halaman-container">
        <div class="navigasi-halaman">
            <a href="{{ route('alamat.index') }}" class="btn btn-secondary">Kembali ke Alamat</a>
        </div>

        <div class="form-tambah">
            <h2>Form Edit Alamat</h2>

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

                @if (session('role') === 'admin')
                    <label>Pelanggan</label>
                    <select name="pelanggan_id" required>
                        @foreach ($pelanggan as $orang)
                            <option value="{{ $orang->id }}" @selected(old('pelanggan_id', $alamat->pelanggan_id) == $orang->id)>
                                {{ $orang->nama }}
                            </option>
                        @endforeach
                    </select>
                @endif

                <label>Label Alamat</label>
                <input type="text" name="label" value="{{ old('label', $alamat->label) }}" placeholder="Contoh: Rumah, Kantor" required>

                <label>Alamat Lengkap</label>
                <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap" required>{{ old('alamat', $alamat->alamat) }}</textarea>

                <label>Kota</label>
                <input type="text" name="kota" value="{{ old('kota', $alamat->kota) }}" required>

                <label>Provinsi</label>
                <input type="text" name="provinsi" value="{{ old('provinsi', $alamat->provinsi) }}" required>

                <label>Kode Pos</label>
                <input type="text" name="kode_pos" value="{{ old('kode_pos', $alamat->kode_pos) }}" required>

                <label>Status</label>
                <select name="status" required>
                    @foreach (['Utama', 'Aktif', 'Nonaktif'] as $status)
                        <option value="{{ $status }}" @selected(old('status', $alamat->status) == $status)>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>

                <div class="form-actions">
                    <button type="submit">Simpan Perubahan</button>
                    <a href="{{ route('alamat.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>