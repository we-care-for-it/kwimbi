<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObjectsResource\Pages;
use App\Filament\Resources\ObjectsResource\RelationManagers;
use App\Models\Elevator;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ObjectsResource extends Resource
{
    protected static ?string $model = Elevator::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

            
    protected static ? string $navigationGroup = 'Objecten';
    protected static ? string $navigationLabel = 'Overzicht';

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
            'index' => Pages\ListObjects::route('/'),
            'create' => Pages\CreateObjects::route('/create'),
            'edit' => Pages\EditObjects::route('/{record}/edit'),
        ];
    }
}
