<?php

namespace App\Http\Controllers;

use App\Models\AlamatPengiriman;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class AlamatPengirimanController extends Controller
{
    private function aturan() {
        return ['pelanggan_id' => 'required|integer', 'label' => 'required', 'alamat' => 'required', 'kota' => 'required', 'provinsi' => 'required', 'kode_pos' => 'required', 'status' => 'required'];
    }

    public function index() {
        return view('alamat.index', ['alamat' => AlamatPengiriman::all(), 'pelanggan' => Pelanggan::all()]);
    }

    public function edit($id) {
        return view('alamat.edit', ['alamat' => AlamatPengiriman::findOrFail($id), 'pelanggan' => Pelanggan::all()]);
    }

    public function store(Request $r) {
        AlamatPengiriman::create($r->validate($this->aturan()));
        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil ditambahkan!');
    }

    public function update(Request $r, $id) {
        AlamatPengiriman::findOrFail($id)->update($r->validate($this->aturan()));
        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil diperbarui!');
    }

    public function destroy($id) {
        AlamatPengiriman::findOrFail($id)->delete();
        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil dihapus!');
    }
}