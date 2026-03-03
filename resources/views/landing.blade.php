<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Kos Impianmu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <span class="text-xl font-bold text-indigo-600">IndeKos</span>
            <a href="/admin" class="text-gray-600 hover:text-indigo-600 font-medium">Panel Admin</a>
        </div>
    </nav>

    <header class="bg-indigo-600 py-20 px-6 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Temukan Kos Nyaman & Estetik</h1>
        <p class="text-indigo-100 text-lg mb-8">Hunian terbaik untuk mahasiswa dan pekerja di sekitar Anda.</p>
        <a href="#daftar-kos" class="bg-white text-indigo-600 px-8 py-3 rounded-full font-semibold shadow-lg hover:bg-gray-100 transition">Lihat Pilihan Kos</a>
    </header>

    <section id="daftar-kos" class="container mx-auto px-6 py-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-10 text-center">Pilihan Properti Terbaru</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($daftarKos as $kos)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                <img src="{{ asset('storage/' . $kos->image) }}" alt="{{ $kos->nama_kos }}" class="w-full h-56 object-cover">
                <div class="p-6">
                    <span class="text-xs font-semibold text-indigo-500 uppercase tracking-wide">{{ $kos->status }}</span>
                    <h3 class="text-xl font-bold text-gray-900 mt-2">{{ $kos->nama_kos }}</h3>
                    <p class="text-gray-500 text-sm mt-1">{{ $kos->alamat }}</p>
                    <div class="flex items-center justify-between mt-6">
                        <span class="text-indigo-600 font-bold text-lg">Rp {{ number_format($kos->harga_per_bulan) }}<span class="text-gray-400 text-sm font-normal">/bln</span></span>
                        <a href="https://wa.me/628123456789?text=Halo, saya tertarik dengan {{ $kos->nama_kos }}" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-full shadow-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-2xl font-bold text-center mb-10">Apa Kata Mereka?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($testimonials as $testi)
                <div class="bg-white p-6 rounded-xl shadow-sm italic text-gray-600">
                    "{{ $testi->pesan }}"
                    <div class="mt-4 font-bold text-gray-800 text-sm not-italic">- {{ $testi->nama_user }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="bg-white py-10 border-t border-gray-200 text-center">
        <p class="text-gray-500 text-sm">&copy; 2026 KosHub - Sistem Manajemen Kos Mahasiswa.</p>
    </footer>
</body>
</html>
