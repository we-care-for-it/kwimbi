<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FleetManagementResource\Pages;
use App\Filament\Resources\FleetManagementResource\RelationManagers;
use App\Models\fleetManagement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;



use Hexters\HexaLite\Traits\HexAccess;
 
 

  



class FleetManagementResource extends Resource
{
    protected static ?string $model = fleetManagement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ? string $navigationGroup = 'Beheer';
    protected static ? string $navigationLabel = 'Wagenpark';
   

    use HexAccess;

    protected static ?array $subPermissions = [
        'access.fleetmanagement.create' => 'Toevoegen',
        'access.fleetmanagement.edit' => 'Wijzigen',
        'access.fleetmanagement.delete' => 'Verwijderen',
    ];
     
 



    
    public static function canAccess(array $parameters = []): bool
{
    return hexa()->can('access.fleetmanagement.create');
}


 
protected static ?string $permissionId = 'access.fleetmanagement';
 
protected static ?string $descriptionPermission = 'Wagenparkbeheer';







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
