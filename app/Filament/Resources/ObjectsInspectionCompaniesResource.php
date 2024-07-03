<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObjectsInspectionCompaniesResource\Pages;
use App\Filament\Resources\ObjectsInspectionCompaniesResource\RelationManagers;
use App\Models\objectInspectionCompany;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ObjectsInspectionCompaniesResource extends Resource
{
    protected static ?string $model = objectInspectionCompany::class;

    protected static ? string $navigationGroup = 'Stamgegevens';
    protected static ? string $navigationLabel = 'Keurinstanties';  
   

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
            'index' => Pages\ListObjectsInspectionCompanies::route('/'),
            'create' => Pages\CreateObjectsInspectionCompanies::route('/create'),
            'edit' => Pages\EditObjectsInspectionCompanies::route('/{record}/edit'),
        ];
    }
}
