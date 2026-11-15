<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    @php $isAdmin = session('role') === 'admin'; @endphp

    <h1>{{ $isAdmin ? 'Profil Admin' : 'Profil Saya' }}</h1>

    @if (session('success'))
        <p class="pesan">{{ session('success') }}</p>
    @endif

    @if ($isAdmin)
        {{-- HALAMAN ADMIN --}}
        <div class="profil-container">
            <div class="profil-header">
                <div class="avatar-profil">A</div>
                <h2>Administrator</h2>
                <p>Admin Pengelola Website</p>
            </div>

            <div class="profil-info">
                <div class="profil-item"><label>Role</label><p>Administrator</p></div>
                <div class="profil-item"><label>Status</label><p>Aktif</p></div>
            </div>

            <div class="profil-alamat">
                <h3>Menu Pengelolaan</h3>
                <a href="{{ route('alamat.index') }}" class="btn">Kelola Alamat Pengiriman</a>
            </div>
        </div>

        <div class="profil-container">
            <h2>Data Pelanggan</h2>

            <div class="profil-tombol">
                <a href="{{ route('pelanggan.create') }}" class="btn">+ Tambah Pelanggan</a>
            </div>

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

                                <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST" class="form-hapus" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="hapus">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6">Belum ada data pelanggan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @else
        {{-- HALAMAN PELANGGAN --}}
        @forelse ($pelanggan as $item)
            <div class="profil-container">
                <div class="profil-header">
                    <div class="avatar-profil">{{ strtoupper(substr($item->nama, 0, 1)) }}</div>
                    <h2>{{ $item->nama }}</h2>
                    <p>Member {{ $item->member }}</p>
                </div>

                <div class="profil-info">
                    @foreach (['Nama Lengkap' => $item->nama, 'Email' => $item->email, 'Nomor HP' => $item->no_hp, 'Jenis Member' => $item->member] as $label => $nilai)
                        <div class="profil-item">
                            <label>{{ $label }}</label>
                            <p>{{ $nilai }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="profil-alamat">
                    <h3>Alamat Pengiriman</h3>
                    <p>Kelola alamat pengiriman untuk akun kamu.</p>
                    <a href="{{ route('alamat.index') }}" class="btn">Lihat Alamat Pengiriman</a>
                </div>

                <div class="profil-tombol">
                    <a href="{{ route('pelanggan.edit', $item->id) }}" class="btn">Edit Profil</a>
                </div>
            </div>
        @empty
            <div class="profil-container"><p>Data profil tidak ditemukan.</p></div>
        @endforelse
    @endif

    <div class="tombol-keluar">
        <form action="{{ route('pembagian-role.keluar') }}" method="POST">
            @csrf
            <button type="submit" class="btn-keluar">Keluar</button>
        </form>
    </div>

</body>
</html>