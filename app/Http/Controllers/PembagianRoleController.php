<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PembagianRoleController extends Controller
{
    public function index()
    {
        return view('pembagian-role.index', ['pelanggan' => Pelanggan::all()]);
    }

    public function atur(Request $request)
    {
        $data = $request->validate([
            'role'         => 'required|in:admin,pelanggan',
            'pelanggan_id' => 'required_if:role,pelanggan|nullable|exists:daftar_pelanggan,id',
        ]);

        session([
            'role'         => $data['role'],
            'pelanggan_id' => $data['role'] === 'pelanggan' ? $data['pelanggan_id'] : null,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Role berhasil dipilih!');
    }

    public function keluar()
    {
        session()->forget(['role', 'pelanggan_id']);

        return redirect()->route('pembagian-role.index');
    }
}