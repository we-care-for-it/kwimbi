<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObjectsSuppliersResource\Pages;
use App\Filament\Resources\ObjectsSuppliersResource\RelationManagers;
use App\Models\ObjectSupplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ObjectsSuppliersResource extends Resource
{
    protected static ?string $model = ObjectSupplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ? string $navigationGroup = 'Objecten';
    protected static ? string $navigationLabel = 'Leveranciers';  
    
     
   

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListObjectsSuppliers::route('/'),
            'create' => Pages\CreateObjectsSuppliers::route('/create'),
            'edit' => Pages\EditObjectsSuppliers::route('/{record}/edit'),
        ];
    }
}
