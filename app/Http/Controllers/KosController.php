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
    public function create()
{
    // Menampilkan halaman formulir tambah kos [Sumber: Laravel Docs]
    return view('kos.create');
}

public function store(Request $request)
{
    // Validasi input data dari formulir [Sumber: Laravel Validation]
    $request->validate([
        'nama_kos' => 'required',
        'alamat' => 'required',
        'harga_per_bulan' => 'required|numeric',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Logika penyimpanan gambar ke folder storage [Sumber: Laravel Filesystem]
    $imagePath = $request->file('image')->store('foto-kos', 'public');

    // Menyimpan data ke database [Sumber: Eloquent ORM]
    \App\Models\Kos::create([
        'nama_kos' => $request->nama_kos,
        'alamat' => $request->alamat,
        'harga_per_bulan' => $request->harga_per_bulan,
        'status' => 'Tersedia',
        'fasilitas' => $request->fasilitas,
        'image' => $imagePath,
    ]);

    return redirect()->route('kos.index')->with('success', 'Kos berhasil ditambahkan!');
}
  public function edit($id)
{
    // Mengambil data kos berdasarkan ID [Sumber: Laravel Eloquent]
    $kos = \App\Models\Kos::findOrFail($id);
    return view('kos.edit', compact('kos'));
}

public function update(Request $request, $id)
{
    // Validasi data yang diinput [Sumber: Laravel Validation]
    $request->validate([
        'nama_kos' => 'required',
        'alamat' => 'required',
        'harga_per_bulan' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $kos = \App\Models\Kos::findOrFail($id);
    $data = $request->all();

    // Logika jika pengguna mengunggah foto baru [Sumber: Laravel Filesystem]
    if ($request->hasFile('image')) {
        // Hapus foto lama jika ingin menghemat penyimpanan [Sumber: PHP unlink]
        if ($kos->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($kos->image);
        }
        $data['image'] = $request->file('image')->store('foto-kos', 'public');
    }

    $kos->update($data);

    return redirect()->route('kos.index')->with('success', 'Data kos berhasil diperbarui!');
}


}
