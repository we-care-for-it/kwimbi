<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObjectsManagemenCompaniesResource\Pages;
use App\Filament\Resources\ObjectsManagemenCompaniesResource\RelationManagers;
use App\Models\objectManagementCompany;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ObjectsManagemenCompaniesResource extends Resource
{
    protected static ?string $model = objectManagementCompany::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    
    protected static ? string $navigationGroup = 'Stamgegevens';
    protected static ? string $navigationLabel = 'Beheerders';  
   


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
            'index' => Pages\ListObjectsManagemenCompanies::route('/'),
            'create' => Pages\CreateObjectsManagemenCompanies::route('/create'),
            'edit' => Pages\EditObjectsManagemenCompanies::route('/{record}/edit'),
        ];
    }
}
