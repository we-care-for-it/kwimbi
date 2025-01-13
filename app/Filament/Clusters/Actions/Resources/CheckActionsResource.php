<?php

namespace App\Filament\Clusters\Actions\Resources;

use App\Filament\Clusters\Actions;
use App\Filament\Clusters\Actions\Resources\CheckActionsResource\Pages;
use App\Models\SystemAction;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CheckActionsResource extends Resource
{
    protected static ?string $model = SystemAction::class;

    protected static ?string $navigationLabel = 'Keuringacties';
    protected static ?string $title = 'Keuringacties';
    protected static ?int $navigationSort = 3;

    protected static ?string $cluster = Actions::class;

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
                //   Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCheckActions::route('/'),
            'create' => Pages\CreateCheckActions::route('/create'),
            'edit' => Pages\EditCheckActions::route('/{record}/edit'),
        ];
    }
}
