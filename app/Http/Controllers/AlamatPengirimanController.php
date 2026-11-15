<?php

namespace App\Http\Controllers;

use App\Models\AlamatPengiriman;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class AlamatPengirimanController extends Controller
{
    // Helper: Cek role & kembalikan redirect jika tidak valid
    private function cekRole()
    {
        if (!in_array(session('role'), ['admin', 'pelanggan'])) {
            return redirect()->route('pembagian-role.index');
        }
        return null;
    }

    // Helper: Ambil data pelanggan sesuai role
    private function getPelanggan()
    {
        return session('role') === 'admin'
            ? Pelanggan::all()
            : Pelanggan::where('id', session('pelanggan_id'))->get();
    }

    // Helper: Validasi input & tentukan pemilik alamat
    private function validasiAlamat(Request $request)
    {
        $rules = [
            'label'    => 'required',
            'alamat'   => 'required',
            'kota'     => 'required',
            'provinsi' => 'required',
            'kode_pos' => 'required',
            'status'   => 'required',
        ];

        if (session('role') === 'admin') {
            $rules['pelanggan_id'] = 'required|exists:daftar_pelanggan,id';
        }

        $data = $request->validate($rules);

        if (session('role') === 'pelanggan') {
            $data['pelanggan_id'] = session('pelanggan_id');
        }

        return $data;
    }

    // Helper: Pastikan pelanggan hanya mengakses datanya sendiri
    private function cekKepemilikan(AlamatPengiriman $alamat)
    {
        if (session('role') === 'pelanggan') {
            abort_unless(
                $alamat->pelanggan_id == session('pelanggan_id'),
                403,
                'Anda tidak memiliki akses ke alamat ini.'
            );
        }
    }

    public function index()
    {
        if ($redirect = $this->cekRole()) return $redirect;

        $alamat = AlamatPengiriman::with('pelanggan')
            ->when(session('role') === 'pelanggan', fn($q) => $q->where('pelanggan_id', session('pelanggan_id')))
            ->get();

        return view('alamat.index', [
            'alamat'    => $alamat,
            'pelanggan' => $this->getPelanggan(),
        ]);
    }

    public function create()
    {
        return redirect()->route('alamat.index');
    }

    public function store(Request $request)
    {
        if ($redirect = $this->cekRole()) return $redirect;

        AlamatPengiriman::create($this->validasiAlamat($request));

        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if ($redirect = $this->cekRole()) return $redirect;

        $alamat = AlamatPengiriman::findOrFail($id);
        $this->cekKepemilikan($alamat);

        return view('alamat.edit', [
            'alamat'    => $alamat,
            'pelanggan' => $this->getPelanggan(),
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($redirect = $this->cekRole()) return $redirect;

        $alamat = AlamatPengiriman::findOrFail($id);
        $this->cekKepemilikan($alamat);

        $alamat->update($this->validasiAlamat($request));

        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if ($redirect = $this->cekRole()) return $redirect;

        $alamat = AlamatPengiriman::findOrFail($id);
        $this->cekKepemilikan($alamat);

        $alamat->delete();

        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil dihapus!');
    }
}