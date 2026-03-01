<?php

namespace App\Filament\Resources;

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
                ImageColumn::make('image')
            ->circular(), 
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
