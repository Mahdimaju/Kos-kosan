<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Properti - {{ $kos->nama_kos }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50 py-10">
    <div class="container mx-auto px-4 max-w-2xl">
        <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Edit Properti Kos</h1>
            
            <form action="{{ route('kos.update', $kos->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kos</label>
                        <input type="text" name="nama_kos" value="{{ $kos->nama_kos }}" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" required>{{ $kos->alamat }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Harga / Bulan (Rp)</label>
                            <input type="number" name="harga_per_bulan" value="{{ $kos->harga_per_bulan }}" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                                <option value="Tersedia" {{ $kos->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="Penuh" {{ $kos->status == 'Penuh' ? 'selected' : '' }}>Penuh</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Foto (Kosongkan jika tidak ingin ganti)</label>
                        <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        <p class="text-xs text-gray-400 mt-1">Foto saat ini: {{ $kos->image }}</p>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition shadow-md">Simpan Perubahan</button>
                        <a href="{{ route('kos.index') }}" class="w-1/3 bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold py-3 rounded-xl text-center transition">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
