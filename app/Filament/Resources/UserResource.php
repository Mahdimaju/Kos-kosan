<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput; // Import untuk input teks [Sumber: Filament Docs]
use Filament\Tables\Columns\TextColumn; // Import untuk kolom tabel [Sumber: Filament Docs]
use Illuminate\Support\Facades\Hash; // Import untuk enkripsi password [Sumber: Laravel Docs]

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users'; // Menambahkan icon user [Sumber: Heroicons]

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Menambahkan input Nama [Sumber: Filament Docs]
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                // Menambahkan input Email dengan validasi format [Sumber: Filament Docs]
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                // Menambahkan input Password yang dienkripsi secara otomatis [Sumber: Filament Docs]
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)) // Enkripsi sebelum simpan [Sumber: Laravel Docs]
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create'), // Wajib diisi hanya saat buat baru
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Menampilkan kolom Nama di tabel daftar user [Sumber: Filament Docs]
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                // Menampilkan kolom Email [Sumber: Filament Docs]
                TextColumn::make('email')
                    ->searchable(),

                // Menampilkan tanggal akun dibuat [Sumber: Filament Docs]
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Tanggal Bergabung'),
            ]);
    }

    public static function getPages(): array
{
    return [
        // Menghubungkan rute index ke halaman ListUsers [Sumber: Filament Docs]
        'index' => Pages\ListUsers::route('/'),
        'create' => Pages\CreateUser::route('/create'),
        'edit' => Pages\EditUser::route('/{record}/edit'),
    ];
}

}
