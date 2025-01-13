<?php

namespace App\Filament\Clusters\Actions\Resources;

use App\Filament\Clusters\Actions;
use App\Filament\Clusters\Actions\Resources\AllActionsResource\Pages;
use App\Models\systemAction;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AllActionsResource extends Resource
{
    protected static ?string $model = systemAction::class;
    protected static ?string $navigationLabel = 'Alle acties';
    protected static ?string $title = 'Alle acties';
    protected static ?int $navigationSort = 2;
    protected static ?string $cluster = Actions::class;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

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
            'index' => Pages\ListAllActions::route('/'),
            'create' => Pages\CreateAllActions::route('/create'),
            'edit' => Pages\EditAllActions::route('/{record}/edit'),
        ];
    }
}
