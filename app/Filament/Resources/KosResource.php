<?php

namespace App\Filament\Resources;

use Filament\Tables\Columns\ImageColumn; // Tambahkan baris ini! [Sumber: Filament Docs]
use Filament\Forms\Components\FileUpload; // Tambahkan ini agar FileUpload dikenali [Sumber: Filament Docs]
use Filament\Tables\Columns\TextColumn; // Untuk menampilkan teks [Sumber: Filament Docs]

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

use App\Filament\Resources\KosResource\Pages;
use App\Filament\Resources\KosResource\RelationManagers;
use App\Models\Kos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KosResource extends Resource
{
    protected static ?string $model = Kos::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form {
    return $form->schema([
      FileUpload::make('image')
            ->image()
            ->directory('foto-kos'),
        Forms\Components\TextInput::make('nama_kos')->required(), // Input Nama [Sumber: Filament Forms]
        Forms\Components\Textarea::make('alamat')->required(), // Input Alamat [Sumber: Filament Forms]
        Forms\Components\TextInput::make('harga_per_bulan')->numeric()->prefix('Rp'), // Input Harga [Sumber: Filament Forms]
        Forms\Components\Select::make('status') // Pilihan Status [Sumber: Filament Forms]
            ->options(['Tersedia' => 'Tersedia', 'Penuh' => 'Penuh']),
    ]);
}


public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\ImageColumn::make('image')
                ->label('Foto'), // Memberi label pada kolom [Sumber: Filament Docs]

            TextColumn::make('nama_kos')
                ->searchable() // Agar admin bisa mencari nama kos [Sumber: Filament Docs]
                ->sortable(),

            TextColumn::make('harga_per_bulan')
                ->money('IDR') // Format mata uang Rupiah [Sumber: Filament Docs]
                ->sortable(),

            TextColumn::make('status')
                ->badge() // Tampilan seperti label berwarna [Sumber: Filament Docs]
                ->color(fn (string $state): string => match ($state) {
                    'Tersedia' => 'success',
                    'Penuh' => 'danger',
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
            'index' => Pages\ListKos::route('/'),
            'create' => Pages\CreateKos::route('/create'),
            'edit' => Pages\EditKos::route('/{record}/edit'),
        ];
    }
}
