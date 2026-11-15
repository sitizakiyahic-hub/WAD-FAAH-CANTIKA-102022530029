<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    // Helper: Cek role & kembalikan redirect jika belum dipilih/tidak valid
    private function cekRole()
    {
        if (!in_array(session('role'), ['admin', 'pelanggan'])) {
            return redirect()->route('pembagian-role.index');
        }
        return null;
    }

    // Helper: Batasi akses khusus admin
    private function hanyaAdmin($pesan = 'Anda tidak memiliki akses.')
    {
        abort_unless(session('role') === 'admin', 403, $pesan);
    }

    // Helper: Pastikan pelanggan hanya mengakses profil sendiri
    private function cekKepemilikan(Pelanggan $pelanggan)
    {
        if (session('role') === 'pelanggan') {
            abort_unless($pelanggan->id == session('pelanggan_id'), 403, 'Anda hanya boleh mengedit profil sendiri.');
        }
    }

    // Helper: Validasi input data pelanggan
    private function validasiPelanggan(Request $request)
    {
        return $request->validate([
            'nama'   => 'required',
            'email'  => 'required|email',
            'no_hp'  => 'required',
            'member' => 'required',
        ]);
    }

    public function index()
    {
        if ($redirect = $this->cekRole()) return $redirect;

        $pelanggan = session('role') === 'admin'
            ? Pelanggan::all()
            : Pelanggan::where('id', session('pelanggan_id'))->get();

        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        $this->hanyaAdmin('Anda tidak memiliki akses untuk menambah pelanggan.');
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $this->hanyaAdmin('Anda tidak memiliki akses untuk menambah pelanggan.');
        Pelanggan::create($this->validasiPelanggan($request));

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if ($redirect = $this->cekRole()) return $redirect;

        $pelanggan = Pelanggan::findOrFail($id);
        $this->cekKepemilikan($pelanggan);

        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        if ($redirect = $this->cekRole()) return $redirect;

        $pelanggan = Pelanggan::findOrFail($id);
        $this->cekKepemilikan($pelanggan);

        $pelanggan->update($this->validasiPelanggan($request));

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $this->hanyaAdmin('Anda tidak memiliki akses untuk menghapus pelanggan.');
        Pelanggan::findOrFail($id)->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}