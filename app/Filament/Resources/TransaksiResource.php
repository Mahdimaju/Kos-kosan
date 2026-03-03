<?php

namespace App\Filament\Resources;

use Filament\Tables\Columns\TextColumn; // Komponen untuk menampilkan data teks [Sumber: Filament Docs]

use App\Filament\Resources\TransaksiResource\Pages;
use App\Filament\Resources\TransaksiResource\RelationManagers;
use App\Models\Transaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form {
    return $form->schema([
        Forms\Components\Select::make('kos_id')
            ->relationship('kos', 'nama_kos') // Mengambil data dari tabel Kos [Sumber: Filament Relationship]
            ->required(),
        Forms\Components\TextInput::make('nama_penyewa')->required(),
        Forms\Components\TextInput::make('jumlah_pembayaran')->numeric()->prefix('Rp'),
        Forms\Components\DatePicker::make('tanggal_pembayaran')->required(),
        Forms\Components\Select::make('status')
            ->options(['Pending' => 'Pending', 'Lunas' => 'Lunas', 'Batal' => 'Batal']),
    ]);
}


   public static function table(Table $table): Table
{
    return $table
        ->columns([
            // Menampilkan nama penyewa dengan fitur pencarian [Sumber: Filament Docs]
            TextColumn::make('nama_penyewa')
                ->label('Penyewa')
                ->searchable(),

            // Mengambil nama kos melalui relasi yang sudah kita buat di Model [Sumber: Laravel Eloquent]
            TextColumn::make('kos.nama_kos')
                ->label('Nama Kos'),

            // Memformat angka menjadi mata uang Rupiah secara otomatis [Sumber: Filament Docs]
            TextColumn::make('jumlah_pembayaran')
                ->money('IDR')
                ->label('Total Bayar'),

            // Menampilkan tanggal dengan format yang rapi [Sumber: PHP Date]
            TextColumn::make('tanggal_pembayaran')
                ->date()
                ->label('Tanggal'),

            // Memberikan warna pada status (Lunas = Hijau, Pending = Kuning) [Sumber: Filament UI]
            TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Lunas' => 'success',
                    'Pending' => 'warning',
                    default => 'gray',
                }),
        ]);
}


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}
