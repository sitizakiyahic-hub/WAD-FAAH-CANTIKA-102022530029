<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f2ff; margin: 0; padding: 30px; color: #333; }
        .container { max-width: 1100px; margin: auto; }
        h1 { color: #6c4ab6; }
        .card { background: white; padding: 24px; border-radius: 12px; box-shadow: 0 3px 10px #ddd; margin-top: 20px; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #7856c9; color: white; }
        .btn, .btn-tambah { display: inline-block; padding: 10px 14px; background: #7856c9; color: white; border-radius: 6px; text-decoration: none; border: none; cursor: pointer; }
        .btn:hover, .btn-tambah:hover { background: #6240aa; }
        .btn-tambah { margin-bottom: 5px; padding: 10px 16px; }
        .btn-hapus { background: #e05b68; color: white; border: none; padding: 8px 12px; border-radius: 6px; cursor: pointer; }
        .btn-hapus:hover { background: #c83e4b; }
        .message { background: #e4f8e8; color: #256b35; padding: 12px; border-radius: 6px; }
        .aksi { white-space: nowrap; }
        .jumlah { margin-top: 20px; }
        .btn-edit { display: inline-block; background: #4b9b78; color: white; padding: 8px 12px; border-radius: 6px; text-decoration: none; margin-right: 5px; }
        .btn-edit:hover { background: #357858; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Pelanggan</h1>
        <p>Pengelolaan data pelanggan toko online</p>

        @if (session('success'))
            <p class="message">{{ session('success') }}</p>
        @endif

        <div class="card">
            <h2>Data Pelanggan</h2>
            <a href="{{ route('pelanggan.create') }}" class="btn-tambah">+ Tambah Pelanggan</a>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Member</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelanggan as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->no_hp }}</td>
                            <td>{{ $data->member }}</td>
                            <td class="aksi">
                                <a href="{{ route('pelanggan.edit', $data->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('pelanggan.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-hapus">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Belum ada data pelanggan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <p class="jumlah">Jumlah pelanggan: <strong>{{ $pelanggan->count() }}</strong></p>
            <a class="btn" href="{{ route('alamat.index') }}">Lihat Alamat Pengiriman</a>
        </div>
    </div>
</body>
</html>