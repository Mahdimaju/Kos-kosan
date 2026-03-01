<?php

namespace Database\Seeders;

use App\Models\Kos;
use App\Models\Transaksi;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class KosSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Kos [Sumber: Eloquent Create]
        $kos1 = Kos::create([
            'nama_kos' => 'Kos Mentari Biru',
            'alamat' => 'Jl. Pendidikan No. 12, Banjarmasin',
            'harga_per_bulan' => 850000,
            'status' => 'Tersedia',
            'fasilitas' => 'WiFi, Kamar Mandi Dalam, Kasur'
        ]);

        $kos2 = Kos::create([
            'nama_kos' => 'Kos Ghibli Aesthetic',
            'alamat' => 'Jl. Veteran Gg. 5, Martapura',
            'harga_per_bulan' => 1200000,
            'status' => 'Penuh',
            'fasilitas' => 'AC, WiFi, Parkir Luas'
        ]);

        // 2. Data Transaksi [Sumber: Eloquent Create]
        Transaksi::create([
            'kos_id' => $kos1->id,
            'nama_penyewa' => 'Budi Santoso',
            'jumlah_pembayaran' => 850000,
            'tanggal_pembayaran' => now(),
            'status' => 'Lunas'
        ]);

        // 3. Data Testimonial [Sumber: Eloquent Create]
        Testimonial::create([
            'nama_user' => 'Siti Aminah',
            'pesan' => 'Tempatnya bersih dan tenang, cocok untuk mahasiswa.',
            'rating' => 5
        ]);
    }
}
