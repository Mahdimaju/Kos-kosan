<?php

namespace App\Filament\Widgets;

use App\Models\Kos;
use App\Models\Transaksi;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Statistik Total Kos
            Stat::make('Total Properti Kos', Kos::count())
                ->description('Jumlah kos yang terdaftar')
                ->descriptionIcon('heroicon-m-home', IconPosition::Before)
                ->color('primary'),

            // Statistik Booking/Transaksi
            Stat::make('Total Transaksi', Transaksi::count())
                ->description('Semua riwayat pembayaran')
                ->descriptionIcon('heroicon-m-banknotes', IconPosition::Before)
                ->color('success'),
                
            // Statistik Kamar Tersedia
            Stat::make('Kamar Tersedia', Kos::where('status', 'Tersedia')->count())
                ->description('Siap untuk disewakan')
                ->color('warning'),
        ];
    }
}
