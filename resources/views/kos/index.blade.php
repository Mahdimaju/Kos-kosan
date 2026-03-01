<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kos-kosan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-indigo-700">Daftar Kos</h1>
                <p class="text-gray-500 text-sm">Kelola data properti Anda dengan mudah.</p>
            </div>
            <a href="{{ route('kos.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg transition duration-300 flex items-center shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Kos
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-6 py-4">Nama Properti</th>
                            <th class="px-6 py-4 text-center">Harga / Bulan</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($semuaKos as $item)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">{{ $item->nama_kos }}</div>
                                <div class="text-xs text-gray-500">{{ Str::limit($item->alamat, 40) }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-indigo-600 font-bold">Rp {{ number_format($item->harga_per_bulan, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($item->status == 'Tersedia')
                                    <span class="px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">Tersedia</span>
                                @else
                                    <span class="px-3 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">Penuh</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right flex justify-end gap-2">
                                <a href="{{ route('kos.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-700 p-2 rounded-md hover:bg-yellow-50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('kos.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700 p-2 rounded-md hover:bg-red-50 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">
                                Belum ada data kos yang terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
