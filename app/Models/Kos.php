<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    protected $table = 'kos'; // Nama tabel [Source: Eloquent Model Convention]
    protected $fillable = ['nama_kos', 'alamat', 'harga_per_bulan', 'status', 'fasilitas', 'image'];
 // Kolom yang dapat diisi [Source: Mass Assignment]
}
