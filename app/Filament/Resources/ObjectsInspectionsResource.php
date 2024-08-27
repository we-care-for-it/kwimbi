<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObjectsInspectionsResource\Pages;
use App\Filament\Resources\ObjectsInspectionsResource\RelationManagers;
use App\Models\objectsInspection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ObjectsInspectionsResource extends Resource
{
    protected static ?string $model = objectsInspection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

       
    protected static ? string $navigationGroup = 'Objecten';
    protected static ? string $navigationLabel = 'Keuringen';  

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
            'index' => Pages\ListObjectsInspections::route('/'),
            'create' => Pages\CreateObjectsInspections::route('/create'),
            'edit' => Pages\EditObjectsInspections::route('/{record}/edit'),
        ];
    }
}
