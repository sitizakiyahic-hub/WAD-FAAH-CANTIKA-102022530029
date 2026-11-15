<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alamat Pengiriman</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    @php $isAdmin = session('role') === 'admin'; @endphp

    <h1>Alamat Pengiriman</h1>

    <div class="halaman-container">
        <div class="navigasi-halaman">
            <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali ke Profil</a>
        </div>

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

        
        <div class="form-tambah">
            <h2>Tambah Alamat Baru</h2>

            <form action="{{ route('alamat.store') }}" method="POST">
                @csrf

                @if ($isAdmin)
                    <label>Pelanggan</label>
                    <select name="pelanggan_id" required>
                        <option value="">Pilih Pelanggan</option>
                        @foreach ($pelanggan as $orang)
                            <option value="{{ $orang->id }}" @selected(old('pelanggan_id') == $orang->id)>
                                {{ $orang->nama }}
                            </option>
                        @endforeach
                    </select>
                @endif

                <label>Label Alamat</label>
                <input type="text" name="label" value="{{ old('label') }}" placeholder="Contoh: Rumah, Kantor" required>

                <label>Alamat Lengkap</label>
                <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>

                <label>Kota</label>
                <input type="text" name="kota" value="{{ old('kota') }}" placeholder="Masukkan kota" required>

                <label>Provinsi</label>
                <input type="text" name="provinsi" value="{{ old('provinsi') }}" placeholder="Masukkan provinsi" required>

                <label>Kode Pos</label>
                <input type="text" name="kode_pos" value="{{ old('kode_pos') }}" placeholder="Masukkan kode pos" required>

                <label>Status</label>
                <select name="status" required>
                    <option value="">Pilih Status</option>
                    @foreach (['Utama', 'Aktif', 'Nonaktif'] as $status)
                        <option value="{{ $status }}" @selected(old('status') == $status)>{{ $status }}</option>
                    @endforeach
                </select>

                <div class="form-actions">
                    <button type="submit">Simpan Alamat</button>
                </div>
            </form>
        </div>

       
        <div class="daftar-alamat">
            <h2>{{ $isAdmin ? 'Semua Alamat Pelanggan' : 'Alamat Saya' }}</h2>

            <div class="tabel-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            @if ($isAdmin) <th>Pelanggan</th> @endif
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
                                @if ($isAdmin) <td>{{ $item->pelanggan?->nama ?? 'Pelanggan tidak ditemukan' }}</td> @endif
                                <td>{{ $item->label }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->kota }}</td>
                                <td>{{ $item->provinsi }}</td>
                                <td>{{ $item->kode_pos }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <div class="aksi-tabel">
                                        <a href="{{ route('alamat.edit', $item->id) }}">Edit</a>

                                        <form action="{{ route('alamat.destroy', $item->id) }}" method="POST" class="form-inline" onsubmit="return confirm('Yakin ingin menghapus alamat ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="hapus">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $isAdmin ? 9 : 8 }}">Belum ada alamat pengiriman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>