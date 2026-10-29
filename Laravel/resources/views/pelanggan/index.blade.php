<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; color: #333; }
        a, button { cursor: pointer; }
        .btn { display: inline-block; padding: 8px 12px; background: #2563eb; color: white; text-decoration: none; border: 0; border-radius: 4px; }
        .hapus { background: #dc2626; color: white; border: 0; padding: 7px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #f3f4f6; }
        .pesan { color: green; margin: 15px 0; }
    </style>
</head>
<body>
    <h1>Data Pelanggan</h1>

    <p>
        <a href="{{ route('pelanggan.create') }}" class="btn">+ Tambah Pelanggan</a>
        <a href="{{ route('alamat.index') }}" class="btn">Alamat Pengiriman</a>
    </p>

    @if (session('success'))
        <p class="pesan">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Member</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pelanggan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>{{ $item->member }}</td>
                    <td>
                        <a href="{{ route('pelanggan.edit', $item->id) }}">Edit</a>

                        <form action="{{ route('pelanggan.destroy', $item->id) }}"
                              method="POST"
                              style="display:inline"
                              onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="hapus">Hapus</button>
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
</body>
</html>
