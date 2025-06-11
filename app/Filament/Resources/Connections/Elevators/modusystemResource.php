<?php
namespace App\Filament\Resources\Connections\Elevators;

use App\Filament\Resources\Connections\Elevators\modusystemResource\Pages;
use App\Models\Connections\Elevators\modusystem;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class modusystemResource extends Resource
{
    protected static ?string $model                 = modusystem::class;
    protected static ?string $slug                  = 'connection.elevators.modusystem';
    protected static ?string $navigationIcon        = 'heroicon-o-rectangle-stack';
    protected static bool $shouldRegisterNavigation = false;

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
            'index'  => Pages\Listmodusystems::route('/'),
            'create' => Pages\Createmodusystem::route('/create'),
            'edit'   => Pages\Editmodusystem::route('/{record}/edit'),
        ];
    }
}
