<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index() {
        return view('pelanggan.index', ['pelanggan' => Pelanggan::all()]);
    }

    public function create() {
        return view('pelanggan.create');
    }

    public function store(Request $r) {
        Pelanggan::create($r->validate(['nama' => 'required', 'email' => 'required|email', 'no_hp' => 'required', 'member' => 'required']));
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function edit($id) {
        return view('pelanggan.edit', ['pelanggan' => Pelanggan::findOrFail($id)]);
    }

    public function update(Request $r, $id) {
        Pelanggan::findOrFail($id)->update($r->validate(['nama' => 'required', 'email' => 'required|email', 'no_hp' => 'required', 'member' => 'required']));
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui!');
    }

    public function destroy($id) {
        Pelanggan::findOrFail($id)->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}