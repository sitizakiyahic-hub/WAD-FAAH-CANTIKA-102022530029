<?php

namespace App\Http\Controllers;

use App\Models\AlamatPengiriman;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class AlamatPengirimanController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->input('cari');

        $query = AlamatPengiriman::query();

        if ($cari) {
            $query->where(function ($q) use ($cari) {
                $q->where('label', 'like', "%{$cari}%")
                    ->orWhere('alamat', 'like', "%{$cari}%")
                    ->orWhere('kota', 'like', "%{$cari}%")
                    ->orWhere('provinsi', 'like', "%{$cari}%")
                    ->orWhere('kode_pos', 'like', "%{$cari}%");
            });

            $idPelanggan = Pelanggan::where(
                'nama',
                'like',
                "%{$cari}%"
            )->pluck('id');

            $query->orWhereIn('pelanggan_id', $idPelanggan);
        }

        $alamat = $query->get();
        $pelanggan = Pelanggan::all();

        return view('alamat.index', compact(
            'alamat',
            'pelanggan',
            'cari'
        ));
    }

    public function create()
    {
        return redirect()->route('alamat.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pelanggan_id' => 'required|integer',
            'label' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'kode_pos' => 'required',
            'status' => 'required',
        ]);

        AlamatPengiriman::create($data);

        return redirect()->route('alamat.index')
            ->with('success', 'Alamat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $alamat = AlamatPengiriman::findOrFail($id);
        $pelanggan = Pelanggan::all();

        return view('alamat.edit', compact('alamat', 'pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'pelanggan_id' => 'required|integer',
            'label' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'kode_pos' => 'required',
            'status' => 'required',
        ]);

        $alamat = AlamatPengiriman::findOrFail($id);
        $alamat->update($data);

        return redirect()->route('alamat.index')
            ->with('success', 'Alamat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $alamat = AlamatPengiriman::findOrFail($id);
        $alamat->delete();

        return redirect()->route('alamat.index')
            ->with('success', 'Alamat berhasil dihapus!');
    }
}
