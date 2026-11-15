<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembagian Role</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <h1>Selamat Datang!</h1>
    <h2 class="judul-role">Silakan Pilih Hak Akses</h2>

    <div class="role-container">
        <form action="{{ route('pembagian-role.atur') }}" method="POST">
            @csrf

            <label>Masuk sebagai</label>
            <select name="role" id="role" required>
                <option value="admin" @selected(old('role') === 'admin')>Admin</option>
                <option value="pelanggan" @selected(old('role') === 'pelanggan')>Pelanggan</option>
            </select>

            <div id="pilihan-pelanggan" class="pilihan-pelanggan">
                <label>Pilih Identitas Pelanggan</label>
                <select name="pelanggan_id" id="pelanggan_id">
                    <option value="">-- Pilih Nama Pelanggan --</option>
                    @foreach ($pelanggan as $item)
                        <option value="{{ $item->id }}" @selected(old('pelanggan_id') == $item->id)>{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>

            @foreach (['role', 'pelanggan_id'] as $field)
                @error($field) <p class="error">{{ $message }}</p> @enderror
            @endforeach

            <button type="submit" class="tombol-role">Lanjutkan</button>
        </form>
    </div>

    <script>
        const role = document.getElementById('role'),
              pilihan = document.getElementById('pilihan-pelanggan'),
              pelanggan = document.getElementById('pelanggan_id');

        const togglePelanggan = () => {
            const isPelanggan = role.value === 'pelanggan';
            pilihan.style.display = isPelanggan ? 'block' : 'none';
            pelanggan.required = isPelanggan;
            if (!isPelanggan) pelanggan.value = '';
        };

        role.onchange = togglePelanggan;
        togglePelanggan();
    </script>

</body>
</html>