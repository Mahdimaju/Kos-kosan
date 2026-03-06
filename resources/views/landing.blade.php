<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IndeKos - Cari Kos Nyaman & Mudah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .bg-tiket-blue { background-color: #0064D2; }
        .text-tiket-blue { color: #0064D2; }
        .bg-tiket-yellow { background-color: #FDC300; }
        /* Animasi loading sederhana */
        .loading { opacity: 0.5; pointer-events: none; cursor: not-allowed; }
    </style>
</head>
<body class="bg-[#F4F7FA]">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 md:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="bg-tiket-blue p-2 rounded-lg">
                    <span class="text-white font-bold text-xl italic">IK</span>
                </div>
                <span class="text-2xl font-extrabold text-tiket-blue tracking-tight">IndeKos</span>
            </div>
            <div class="hidden md:flex gap-6 items-center">
                <a href="#" class="text-gray-600 font-medium hover:text-tiket-blue">Cek Order</a>
                <a href="/admin" class="bg-tiket-blue text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-blue-700 transition">Panel Admin</a>
            </div>
            <button id="open-menu" class="md:hidden text-tiket-blue focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </nav>

    <div id="side-menu" class="fixed inset-0 z-[60] hidden">
        <div id="close-overlay" class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
        <div class="absolute right-0 top-0 h-full w-64 bg-white shadow-2xl transform transition-transform duration-300 translate-x-full" id="side-content">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <span class="font-bold text-tiket-blue">Menu Utama</span>
                    <button id="close-menu" class="text-gray-400 hover:text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <nav class="flex flex-col gap-4">
                    <a href="/" class="text-gray-700 font-medium p-3 hover:bg-blue-50 rounded-lg flex items-center gap-3">🏠 Home</a>
                    <a href="#" class="text-gray-700 font-medium p-3 hover:bg-blue-50 rounded-lg flex items-center gap-3">📋 Cek Order</a>
                    <hr class="my-2 border-gray-100">
                    <a href="/admin" class="bg-tiket-blue text-white p-4 rounded-xl font-bold text-center shadow-lg shadow-blue-200">Masuk Panel Admin</a>
                </nav>
            </div>
        </div>
    </div>

    <header class="bg-tiket-blue pt-12 pb-24 px-6 text-center text-white relative">
        <h1 class="text-3xl md:text-5xl font-bold mb-4">Mau nginep di mana?</h1>
        <p class="text-blue-100 text-sm md:text-lg mb-8">Temukan ribuan kos terbaik dengan harga transparan.</p>
        <div class="absolute -bottom-10 left-1/2 transform -translate-x-1/2 w-[90%] md:w-[80%] lg:w-[70%] bg-white rounded-xl shadow-2xl p-4 md:p-6 flex flex-col md:flex-row gap-4 items-center">
            <div class="flex-1 text-left border-b md:border-b-0 md:border-r border-gray-200 pb-2 md:pb-0 w-full">
                <p class="text-xs text-gray-400 font-bold uppercase">Lokasi</p>
                <p class="text-gray-800 font-semibold">Sekitar Kampus UNISM</p>
            </div>
            <div class="flex-1 text-left w-full">
                <p class="text-xs text-gray-400 font-bold uppercase">Tipe Kos</p>
                <p class="text-gray-800 font-semibold">Putra / Putri / Campur</p>
            </div>
            <button class="bg-tiket-yellow text-blue-900 w-full md:w-auto px-10 py-3 rounded-full font-bold shadow-md hover:brightness-95 transition">Cari</button>
        </div>
    </header>

    <section id="daftar-kos" class="container mx-auto px-4 md:px-8 pt-24 pb-16">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-xl md:text-2xl font-bold text-gray-800">Properti Populer</h2>
            <a href="#" class="text-tiket-blue font-bold text-sm hover:underline">Lihat Semua</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($daftarKos as $kos)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition duration-300 flex flex-col">
                <div class="relative">
                    <img src="{{ asset('storage/' . $kos->image) }}" alt="{{ $kos->nama_kos }}" class="w-full h-48 md:h-52 object-cover">
                    <div class="absolute top-3 left-3 bg-white/90 backdrop-blur px-3 py-1 rounded-full shadow-sm">
                        <span class="text-[10px] font-bold text-tiket-blue uppercase tracking-wider">{{ $kos->status }}</span>
                    </div>
                </div>
                
                <div class="p-5 flex-1 flex flex-col">
                    <h3 class="text-lg font-bold text-gray-900 line-clamp-1">{{ $kos->nama_kos }}</h3>
                    <div class="flex items-center gap-1 mt-1 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                        <p class="text-xs truncate">{{ $kos->alamat }}</p>
                    </div>

                    <div class="mt-auto pt-5">
                        <p class="text-[10px] text-gray-400 font-bold uppercase">Mulai dari</p>
                        <div class="flex items-center justify-between">
                            <span class="text-orange-500 font-bold text-xl">
                                Rp {{ number_format($kos->harga_per_bulan) }}
                                <span class="text-gray-400 text-xs font-normal">/bln</span>
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2 mt-4">
                            <button id="btn-pay-{{ $kos->id }}" 
                                    onclick="bayarOtomatis({{ $kos->id }}, this)" 
                                    class="bg-tiket-yellow text-blue-900 py-2 rounded-lg font-bold text-xs hover:brightness-95 transition flex items-center justify-center gap-2">
                                <span>Booking</span>
                            </button>
                            <a href="https://wa.me/628123456789?text=Halo, saya tertarik dengan {{ $kos->nama_kos }}" 
                               class="bg-blue-50 text-tiket-blue border border-blue-100 py-2 rounded-lg font-bold text-xs text-center hover:bg-blue-100 transition">
                                Chat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <footer class="bg-gray-900 py-12 text-white">
        <div class="border-t border-gray-800 mt-12 pt-8 text-center">
            <p class="text-gray-500 text-xs">&copy; 2026 IndeKos - Build with ❤️ in Termux.</p>
        </div>
    </footer>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    
    <script>
        function bayarOtomatis(kosId, button) {
            // 1. Berikan efek loading pada tombol
            const originalText = button.innerHTML;
            button.classList.add('loading');
            button.innerHTML = '<span>Processing...</span>';

            // 2. Tembak ke API Controller kamu
            fetch('/get-payment-token', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ 
                    kos_id: kosId, 
                    nama_penyewa: 'Penyewa Otomatis', // Bisa kamu ganti dengan nama user login jika ada
                    email: 'penyewa@example.com' 
                })
            })
            .then(response => {
                if (!response.ok) throw new Error('Koneksi ke server gagal. Cek terminal Termux!');
                return response.json();
            })
            .then(data => {
                // 3. Munculkan popup Snap [Sumber: Midtrans Docs]
                window.snap.pay(data.token, {
                    onSuccess: function(result) { 
                        alert("Pembayaran Berhasil! Status akan diperbarui otomatis."); 
                        location.reload(); 
                    },
                    onPending: function(result) { 
                        alert("Menunggu pembayaran. Silakan cek Virtual Account Anda."); 
                        location.reload();
                    },
                    onError: function(result) { 
                        alert("Pembayaran Gagal!"); 
                        button.classList.remove('loading');
                        button.innerHTML = originalText;
                    },
                    onClose: function() {
                        button.classList.remove('loading');
                        button.innerHTML = originalText;
                    }
                });
            })
            .catch(error => {
                // Menangani error seperti 111999.jpg
                alert(error.message);
                button.classList.remove('loading');
                button.innerHTML = originalText;
            });
        }

        // Script untuk Side Menu
        const openBtn = document.getElementById('open-menu');
        const closeBtn = document.getElementById('close-menu');
        const overlay = document.getElementById('close-overlay');
        const sideMenu = document.getElementById('side-menu');
        const sideContent = document.getElementById('side-content');

        function toggleMenu() {
            sideMenu.classList.toggle('hidden');
            setTimeout(() => {
                sideContent.classList.toggle('translate-x-full');
            }, 10);
        }

        openBtn.addEventListener('click', toggleMenu);
        closeBtn.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', toggleMenu);
    </script>
</body>
</html>
