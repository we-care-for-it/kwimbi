<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObjectResource\Pages;
use App\Filament\Resources\ObjectResource\RelationManagers;
use App\Models\Elevator;
use App\Models\Inspec;

use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
 
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\ViewEntry;

class ObjectResource extends Resource
{
    protected static ?string $model = Elevator::class;

    protected static ?string $navigationIcon = 'heroicon-m-arrow-up-on-square-stack';
    protected static ? string $navigationLabel = 'Objecten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('unit_no')
                    ->label('Nummer')->searchable()->sortable()
                    ->placeholder('Geen unitnummer'),

                Tables\Columns\TextColumn::make('name')->badge()
                    ->label('Naam')->placeholder('-'),

                Tables\Columns\TextColumn::make('nobo_no')
                    ->label('Nobonummer')->searchable()
                    ->placeholder('Geen Nobonummer'),

                Tables\Columns\TextColumn::make('location')
                    ->getStateUsing(function (Elevator $record): ?string {
                        if ($record?->location->name) {
                            return $record?->location->name;
                        } else {
                            return $record->location->address . " - " . $record->location->zipcode . " " . $record->location->place;
                        }
                    })
                    ->searchable()
                    ->label('Locatie')
                    ->description(function (Elevator $record) {

                        if (!$record?->location->name) {
                            return $record?->location->name;
                        } else {
                            return $record->location->address . " - " . $record->location->zipcode . " " . $record->location->place;
                        }


                    }
                ),

                Tables\Columns\TextColumn::make('location.address')
                    ->label('Adres')->searchable()->sortable()->hidden(true),

                Tables\Columns\TextColumn::make('location.zipcode')
                    ->label('Postcode')->searchable()->hidden(true),

                Tables\Columns\TextColumn::make('location.place')
                    ->label('Plaats')->searchable(),


                Tables\Columns\TextColumn::make('customer.name')
                    ->searchable()
                    ->label('Relatie')->placeholder('Niet gekoppeld aan relatie')->sortable(),

                Tables\Columns\TextColumn::make('management_company.name')
                    ->searchable()
                    ->label('Beheerder')->placeholder('Geen beheerder')->sortable(),

                Tables\Columns\TextColumn::make('maintenance_company.name')
                    ->searchable()->placeholder('Geen onderhoudspartij')
                    ->sortable()
                    ->label('Onderhoudspartij'),


            ])
            ->filters([
                //
            ])
            ->actions([
                //  Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }


    public static function infolist(Infolist $infolist) : Infolist
    {

        return $infolist->schema([
        
        Components\Section::make()->schema(
            [
                
        Components\Split::make([Components\Grid::make(4)->schema([
   
                Components\TextEntry::make('nobo_no')
                    ->label("NOBO Nummer") , 
        
                Components\TextEntry::make('type.name')
                    ->badge()
                    ->label("Type")
                    ->color('success')
                    ->placeholder("Niet opgegeven") ,

                Components\TextEntry::make('unit_no')
                    ->label("Unit Nummer")
                    ->placeholder("Niet opgegeven") ,  

                ViewEntry::make('energy_label')
                    ->view('filament.infolists.entries.energylabel')
                    ->label("Energielabel")
                    ->placeholder("Niet opgegeven") ,  

                Components\TextEntry::make('install_date')
                    ->label("Installatie datum")->date('m-d-Y')
                    ->placeholder("Niet opgegeven") , 
                    
                Components\TextEntry::make('status_id')
                    ->label("Status")
                    ->badge()
                    ->placeholder("Niet opgegeven") ,  
                    
                Components\TextEntry::make('supplier.name')
                    ->label("Leverancier")
                    ->placeholder("Niet opgegeven") ,  

                Components\TextEntry::make('customer.name')
                    ->label("Relatie")
                    ->placeholder("Niet opgegeven") ,  
                        
                Components\TextEntry::make('stopping_places')
                    ->label("Stoppplaatsen")
                    ->placeholder("Niet opgegeven") ,  

                Components\TextEntry::make('construction_year')
                    ->label("Bouwjaar")
                    ->placeholder("Niet opgegeven") , 
                
                Components\TextEntry::make('inspectioncompany.name')
                    ->label("Onderhoudspartij")
                    ->placeholder("Niet opgegeven")  
 
            , ]) ,

        ])
            ->from('lg') , ])  

       
  ,
 


        Components\Section::make()->schema(
            [
                
                Components\Split::make([
                    
       
               
                        Components\TextEntry::make('remark')
                  
                        ->label("Opmerking")  ->placeholder("Geen opmerking")
                        ])
                  
                      
                    ]) 
                
                ]);

    }


    public static function getRelations(): array
    {
        return [
            RelationManagers\FeatureRelationManager::class,
            RelationManagers\IncidentsRelationManager::class,
            RelationManagers\MaintenanceContractsRelationManager::class,
            RelationManagers\MaintenanceVisitsRelationManager::class,
            RelationManagers\inspectionsRelationManager::class,
       //     RelationManagers\AttachmentRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObjects::route('/'),
            'create' => Pages\CreateObject::route('/create'),
            'edit' => Pages\EditObject::route('/{record}/edit'),
            'view' => Pages\ViewObject::route('/{record}'),
        ];
    }
}
