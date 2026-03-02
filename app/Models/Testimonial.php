<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    // Mendaftarkan kolom agar bisa diisi secara otomatis [Sumber: Laravel Docs]
    protected $fillable = [
        'nama_user', 
        'pesan', 
        'rating'
    ];
}
