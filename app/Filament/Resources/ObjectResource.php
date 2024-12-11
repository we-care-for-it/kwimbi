<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObjectResource\Pages;
use App\Filament\Resources\ObjectResource\RelationManagers;
use App\Models\Elevator;
use App\Models\ObjectMaintenanceCompany;
use App\Models\ObjectSupplier;
use App\Models\Customer;

use App\Enums\ElevatorStatus;



use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
 
 
//Form
 
 
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\Split;
 


//Form
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
 
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;





use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\ViewEntry;
 
use App\Models\ObjectType;
class ObjectResource extends Resource
{
    protected static ?string $model = Elevator::class;

    protected static ?string $navigationIcon = 'heroicon-m-arrow-up-on-square-stack';
    protected static ? string $navigationLabel = 'Objecten';


       
    public static function form(Form $form) : Form
    {
        return $form->schema([

        Grid::make(4)
            ->schema([

                
                TextInput::make('nobo_no')
                    ->label("NOBO Nummer")
                    ->placeholder("Niet opgegeven") , 
        
                    Select::make('object_type_id')
                    ->label('Type')
                    ->options(ObjectType::where('is_active', 1)->pluck('name', 'id')),


                    TextInput::make('unit_no')
                    ->label("Unit Nummer")
                   ,  

                Select::make('energy_label')
                    
                    ->label("Energielabel")
                    ->options([
                        'a' => "A",
                        'b' => "B",
                        'c' => "C",
                        'd' => "D",
                        'r' => "E",
                        'f' => "F",
                    ]) ,  

                    DatePicker::make('install_date')
                    ->label("Installatie datum")
                    ->placeholder("Niet opgegeven") , 
                    
                Select::make('status_id')
                    ->label("Status")
                    ->options(ElevatorStatus::class) ,

                    


                    
               Select::make('supplier_id')
                    ->label("Leverancier")
                    ->options(ObjectSupplier::
                    pluck('name', 'id')),
                    

                       

                Select::make('customer_id')
                    ->label("Relatie")
                    ->options(Customer::
                    pluck('name', 'id')),
                        
                    TextInput::make('stopping_places')
                    ->label("Stoppplaatsen")
                    ->placeholder("Niet opgegeven") ,  

                    TextInput::make('construction_year')
                    ->label("Bouwjaar")
                    ->placeholder("Niet opgegeven") , 
                
                    Select::make('maintenance_company_id')
                    ->label('Onderhoudspartij')
                    ->options(ObjectMaintenanceCompany::
                    pluck('name', 'id')),
                
                    TextInput::make('name')
                    ->label("Naam")
                    


        ]) ,

     

        Grid::make(2)
            ->schema([ 

  
        Textarea::make('remark')
            ->rows(3)
            ->label('Opmerking')
            ->columnSpan(4)
            ->autosize() ])

        ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('unit_no')
                    ->label('Nummer')->searchable()->sortable()
                    ->placeholder('Geen unitnummer'),


                    Tables\Columns\TextColumn::make("status_id")
                    ->label("Status")
                    ->badge()
                    ->sortable() ,


                Tables\Columns\TextColumn::make('name')
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
                    ->label("NOBO Nummer")
                    ->placeholder("Niet opgegeven") , 
        
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
                    ->placeholder("Niet opgegeven"),
                
                Components\TextEntry::make('name')
                    ->label("Naam")
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
         //   'create' => Pages\CreateObject::route('/create'),
            'edit' => Pages\EditObject::route('/{record}/edit'),
            'view' => Pages\ViewObject::route('/{record}'),
        ];
    }
}
