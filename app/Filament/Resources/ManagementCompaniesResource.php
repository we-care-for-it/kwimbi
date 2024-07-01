<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ManagementCompaniesResource\Pages;
use App\Filament\Resources\ManagementCompaniesResource\RelationManagers;
use App\Models\ManagementCompany;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManagementCompaniesResource extends Resource
{
    protected static ?string $model = ManagementCompany::class;
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            'index' => Pages\ListManagementCompanies::route('/'),
            'create' => Pages\CreateManagementCompanies::route('/create'),
            'edit' => Pages\EditManagementCompanies::route('/{record}/edit'),
        ];
    }
}
