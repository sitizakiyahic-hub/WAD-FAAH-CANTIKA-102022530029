<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
