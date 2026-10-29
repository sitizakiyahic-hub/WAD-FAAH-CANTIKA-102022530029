<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlamatPengiriman extends Model
{
    protected $table = 'alamat_pengiriman';

    public $timestamps = false;

    protected $fillable = [
        'pelanggan_id',
        'label',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos',
        'status',
    ];
}
