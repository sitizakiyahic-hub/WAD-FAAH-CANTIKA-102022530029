<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <h1>Tambah Pelanggan</h1>

    <div class="halaman-container">
        <div class="navigasi-halaman">
            <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali ke Profil Admin</a>
        </div>

        <div class="form-tambah">
            <h2>Form Tambah Pelanggan</h2>

            @if ($errors->any())
                <ul class="error">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form action="{{ route('pelanggan.store') }}" method="POST">
                @csrf

                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required>

                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required>

                <label>Nomor HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Masukkan nomor HP" required>

                <label>Jenis Member</label>
                <select name="member" required>
                    <option value="">Pilih Member</option>
                    @foreach (['Gold', 'Platinum', 'Silver'] as $member)
                        <option value="{{ $member }}" @selected(old('member') == $member)>{{ $member }}</option>
                    @endforeach
                </select>

                <div class="form-actions">
                    <button type="submit">Simpan Pelanggan</button>
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>