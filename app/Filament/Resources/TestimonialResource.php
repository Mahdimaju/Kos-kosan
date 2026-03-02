<?php

namespace App\Filament\Resources; // Pastikan tidak ada typo di sini [Sumber: Laravel Docs]

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
// ... import lainnya

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput; // Import Komponen [Sumber: Filament Docs]
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right'; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Menambahkan kolom input sesuai gambar rencana Anda [Sumber: Filament Docs]
                TextInput::make('nama_user')
                    ->required()
                    ->label('Nama Pengguna'),
                
                Textarea::make('pesan')
                    ->required()
                    ->label('Isi Testimoni'),

                Select::make('rating')
                    ->options([
                        1 => '1 Bintang',
                        2 => '2 Bintang',
                        3 => '3 Bintang',
                        4 => '4 Bintang',
                        5 => '5 Bintang',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Menampilkan data di daftar tabel [Sumber: Filament Docs]
                TextColumn::make('nama_user')->label('Pengirim')->searchable(),
                TextColumn::make('pesan')->limit(50),
                TextColumn::make('rating')->badge()->color('warning'),
                TextColumn::make('created_at')->dateTime()->label('Tanggal'),
            ]);
    }
    public static function getPages(): array
{
    return [
        // Menghubungkan rute 'index' dengan halaman ListTestimonials [Sumber: Filament Docs]
        'index' => Pages\ListTestimonials::route('/'),
        'create' => Pages\CreateTestimonial::route('/create'),
        'edit' => Pages\EditTestimonial::route('/{record}/edit'),
    ];
}

    
    // ... rest of code
}
