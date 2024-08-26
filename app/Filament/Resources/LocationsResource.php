<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocationsResource\Pages;
use App\Filament\Resources\LocationsResource\RelationManagers;
use App\Models\location;
use App\Models\objectBuildingType;
use App\Models\ManagementCompany;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


//Form
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
//Table
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\FileUpload;

use Hexters\HexaLite\Traits\HexAccess;
 
use Filament\Forms\Components\Fieldset;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Filters\SelectFilter;

class LocationsResource extends Resource
{
    protected static ? string $model = location::class;

    protected static ? string $navigationIcon = 'heroicon-o-rectangle-stack';

 
    protected static ? string $navigationLabel = 'Locaties';
    protected static ? string $navigationGroup = 'Hoofdmenu';

    use HexAccess;    public static function form(Form $form): Form
    {
        return $form
        ->schema([

            
            Forms\Components\Section::make()
                ->schema([
                   
                 
                    Forms\Components\TextInput::make('name')
                    ->label('Naam')
                        ->maxLength(255)
                        ->required(),

                    Forms\Components\TextInput::make('zipcode')
                     
                        ->label('Postcode')
                        ->maxLength(255),
                      

                    Forms\Components\TextInput::make('place')
                    ->label('Plaats')
                        ->maxLength(255),

                
                        Forms\Components\TextInput::make('customer.name')
                        ->label('Relatie')
                        ->maxLength(255),

                        Forms\Components\TextInput::make('managementcompany.name')
                        ->label('Beheerder')
                        ->maxLength(255),


                        Forms\Components\TextInput::make('managementcompany.name')
                        ->label('Beheerder')
                        ->maxLength(255),


                  
                       // ->content(fn (Customer $record): ?string => $record->updated_at?->diffForHumans()),
                ])
                ->columnSpan(['lg' => 2]),
              //  ->hidden(fn (?Customer $record) => $record === null),


            Forms\Components\Section::make()
                ->schema([

                    Forms\Components\TextInput::make('emailaddress')
                    ->email()
                    ->label('E-mailadres')   ->columnSpan('full') 

                    ->maxLength(255),
                   
                    Forms\Components\TextInput::make('phonenumber')
                    ->label('Telefoonnummer')   ->columnSpan('full')

                    ->maxLength(255),
              

                    
                ])
                ->columns(2)
          ->columnSpan(['lg' => 1]),

        ])
        ->columns(3);
    }
    public static function table(Table $table): Table
    {
    
        return $table->columns([
    
            ImageColumn::make('image')
            ->label('')
            ->width(100)  ,

     

        Tables\Columns\TextColumn::make('name')
        ->searchable(),
        Tables\Columns\TextColumn::make('zipcode')->label('Postcode')
        ->searchable(),
        Tables\Columns\TextColumn::make('address')->label('Adres')
        ->searchable(),
        Tables\Columns\TextColumn::make('place')->label('Plaats')
        ->searchable(),

        Tables\Columns\TextColumn::make('customer.name')->label('relatie')
        ->searchable(),

        Tables\Columns\TextColumn::make('managementcompany.name')->label('Beheerder')
        ->searchable(),

        
        Tables\Columns\TextColumn::make('buildingType.name')->label('Type')->badge()
        ->searchable()

 
        ])
       

            ->filters([

                SelectFilter::make('building_type_id')
                ->label('Gebouwtype')
                ->options(objectBuildingType::all()
                ->pluck('name', 'id')) ,


                SelectFilter::make('management_id')
                ->label('Beheerder')
                ->options(ManagementCompany::all()
                ->pluck('name', 'id')) ,



                Tables\Filters\TrashedFilter::make(), 
            ])
            ->actions([
                Tables\Actions\EditAction::make()->modalHeading('Wijzigen'),
                Tables\Actions\DeleteAction::make()->modalHeading('Verwijderen van deze rij'),
     
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
              //      Tables\Actions\DeleteBulkAction::make()->modalHeading('Verwijderen van alle geselecteerde rijen'),
           
                ]),
            ]) ->emptyState(view('partials.empty-state')) ;
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
            'index' => Pages\ListLocations::route('/'),
            'create' => Pages\CreateLocations::route('/create'),
            'edit' => Pages\EditLocations::route('/{record}/edit'),
        ];
    }
}
