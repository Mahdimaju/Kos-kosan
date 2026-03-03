<?php

namespace App\Filament\Widgets;

use App\Models\Transaksi;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalPendapatanWidget extends BaseWidget
{
    // Mengatur urutan agar widget ini tampil pertama di Dashboard [Sumber: Filament Docs]
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Menjumlahkan kolom 'jumlah_pembayaran' hanya untuk transaksi yang 'Lunas' [Sumber: Laravel Eloquent]
        $totalLunas = Transaksi::where('status', 'Lunas')->sum('jumlah_pembayaran');

        return [
            Stat::make('Total Pendapatan (Lunas)', 'Rp ' . number_format($totalLunas, 0, ',', '.'))
                ->description('Total uang masuk dari transaksi sukses')
                ->descriptionIcon('heroicon-m-banknotes', IconPosition::Before)
                ->chart([7, 2, 10, 3, 15, 4, 17]) // Contoh data grafik dekoratif [Sumber: Filament UI]
                ->color('success'),
        ];
    }
}
