<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Model
{
    protected $table = 'daftar_pelanggan';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'member',
    ];

    // Satu pelanggan memiliki banyak alamat
    public function alamatPengiriman(): HasMany
    {
        return $this->hasMany(AlamatPengiriman::class, 'pelanggan_id');
    }
}
