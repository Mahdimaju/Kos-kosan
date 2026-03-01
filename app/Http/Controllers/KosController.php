<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class KosController extends Controller
{
    /**
     * Menampilkan daftar kos untuk halaman internal/admin.
     * Fungsi ini dipanggil oleh Route::resource('kos', ...).
     */
    public function index()
    {
        $semuaKos = Kos::all(); 
        return view('kos.index', compact('semuaKos'));
    }

    /**
     * Menampilkan halaman depan (Landing Page) untuk pengunjung.
     * Fungsi ini dipanggil oleh Route::get('/', ...).
     */
    public function landingPage()
    {
        $daftarKos = Kos::all();
        $testimonials = Testimonial::latest()->take(3)->get();
        
        return view('landing', compact('daftarKos', 'testimonials'));
    }
}
