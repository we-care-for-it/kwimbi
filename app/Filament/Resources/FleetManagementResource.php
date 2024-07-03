<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FleetManagementResource\Pages;
use App\Filament\Resources\FleetManagementResource\RelationManagers;
use App\Models\FleetManagement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FleetManagementResource extends Resource
{
    protected static ?string $model = FleetManagement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ? string $navigationGroup = 'Beheer';
    protected static ? string $navigationLabel = 'Wagenpark';
   
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
            'index' => Pages\ListFleetManagement::route('/'),
            'create' => Pages\CreateFleetManagement::route('/create'),
            'edit' => Pages\EditFleetManagement::route('/{record}/edit'),
        ];
    }
}
