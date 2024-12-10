<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ObjectLocationResource\Pages;
use App\Filament\Resources\ObjectLocationResource\RelationManagers;
use App\Models\Customer;
use App\Models\ObjectLocation;
use App\Models\ObjectBuildingType;

use App\Models\ObjectManagementCompany;
use App\Models\Project;
use App\Services\AddressService;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUp;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Columns\Column;
use Filament\Actions\Exports\Models\Export;
use Filament\Tables\Grouping\Group;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\ViewEntry;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;


use Filament\Tables\Filters\SelectFilter;

class ObjectLocationResource extends Resource
{
    protected static ? string $model = ObjectLocation::class;

    protected static ? string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ? string $navigationLabel = "Locaties";
    protected static ? string $navigationGroup = "Hoofdmenu";

    protected static ? string $recordTitleAttribute = 'name';

    public static function infolist(Infolist $infolist) : Infolist
    {

        return $infolist->schema([

        Section::make()->schema([

        Components\Split::make([Components\Grid::make(4)->schema([

        TextEntry::make('address')

            ->label("Adres")->getStateUsing(function (ObjectLocation $record) : ? string
        {


            $housenumber = "";
            if($record->housenumber){
                $housenumber = " ". $record->housenumber;
            } 

            return $record->address . " "  . $housenumber . " - " . $record->zipcode . " " . $record->place;

        })
            ->placeholder("Niet opgegeven") ,

        TextEntry::make('name')
            ->label("Complexnaam")
            ->placeholder("Niet opgegeven") ,

        TextEntry::make('construction_year')
            ->label("Bouwjaar")
            ->placeholder("Niet opgegeven") ,

        TextEntry::make('customer.name')
            ->label("Relatie")
            ->placeholder("Niet opgegeven") ,

        TextEntry::make('buildingtype.name')
            ->label("Gebouwtype")
            ->badge()
            ->placeholder("Niet opgegeven") ,

        TextEntry::make('complexnumber')
            ->label("Complexnummer")
            ->placeholder("Niet opgegeven") ,

        TextEntry::make('province')
            ->label("Provincie")
            ->placeholder("Niet opgegeven") ,

        TextEntry::make('managementcompany.name')
            ->label("Beheerder")
            ->placeholder("Niet opgegeven") ,

        ]) ])

        ])

        ]);
    }

    public static function getGloballySearchableAttributes() : array
    {
        return ['name', 'address'];
    }

    public static function getGlobalSearchResultDetails($record) : array
    {
        return ['Adres' => $record->address . ' , ' . $record->place];
    }

    public static function form(Form $form) : Form
    {
        return $form->schema([Forms\Components\Section::make()
            ->schema([

            Grid::make(2)
                ->schema([Forms\Components\TextInput::make("name")
                ->label("Naam") ,
                
                Forms\Components\TextInput::make("complexnumber")
                ->label("Complexnumber") ,

            Select::make('management_id')
                ->relationship(name : 'managementcompany', titleAttribute:'name')
                ->searchable()
                ->label('Beheerder')
                ->preload()
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->label('Naam van de beheerder')
                    ]) ,

            Select::make('customer_id')
                ->searchable()
                ->label('Relatie')
                ->preload()
                ->required()
                ->createOptionForm([Forms\Components\TextInput::make('name')
                ->required()
                ->label('Naam van de relatie') ])
                ->relationship(name:'customer', titleAttribute:'name')]) ,
                    ]) ,

                    Forms\Components\Section::make("Locatie gegevens")->schema([Grid::make(4)->schema([Forms\Components\TextInput::make("zipcode")
                        ->label("Postcode")
                        ->maxLength(255)->suffixAction(Action::make("searchAddressByZipcode")
                        ->icon("heroicon-m-magnifying-glass")->action(function (Get $get, Set $set)
                    {

                        $data = (new AddressService())->GetAddress($get("zipcode") , $get("number"));
                        $data = json_decode($data);

                        if (isset($data->error_id))
                        {
                            Notification::make()
                                ->warning()
                                ->title("Geen resultaten")
                                ->body("Helaas er zijn geen gegevens gevonden bij de postcode <b>" . $get("zipcode") . "</b> Controleer de postcode en probeer opnieuw.")->send();
                        }
                        else
                        {
                            //dd($data);
                            $set("place", $data ?->municipality);
                            $set("gps_lat", $data ?->lat);
                            $set("gps_lon", $data ?->lng);
                            $set("address", $data ?->street);
                            $set("municipality", $data ?->municipality);
                            $set("province", $data ?->province);
                            $set("place", $data ?->settlement);
                            $set("building_type", $data ?->purposes[0]);
                            $set("construction_year", $data ?->constructionYear);
                            $set("surface", $data ?->surfaceArea);

                        }
                    })) ,

                    Forms\Components\TextInput::make("address")
                        ->label("Straatnaam")
                        ->required()
                        ->columnSpan(2) ,

                    Forms\Components\TextInput::make("housenumber")
                        ->label("Huisnummer") ,

                    Forms\Components\TextInput::make("place")
                        ->label("Plaats") ,

                    Forms\Components\TextInput::make("province")
                        ->label("Provincie") ,

                    Forms\Components\TextInput::make("gps_lat")
                        ->label("GPS latitude")
                        ->columnSpan(1)
                        ->hidden(),

                    Forms\Components\TextInput::make("gps_lon")
                        ->label("GPS longitude")
                        ->columnSpan(1)
                        ->hidden(),

                    // ...
                    ]) , ])
                        ->columns(2)
                        ->columnSpan(3) ,

                    Forms\Components\Section::make("Gebouwgegevens")
                        ->schema([Forms\Components\Grid::make(3)
                        ->schema([Forms\Components\TextInput::make("construction_year")
                        ->label("Bouwjaar") ,

                    Forms\Components\TextInput::make("levels")
                        ->label("Verdiepingen") ,

                    Forms\Components\TextInput::make("surface")
                        ->label("Aantal m2") ,

                     Select::make("building_type_id")
                 ->options(ObjectBuildingType::pluck('name', 'id'))
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Omschrijving')
                        ])    
    
                         ->preload()
                        ->searchable()
                         ->label("Gebouwtype")
                       ->columnSpan(3)
                        
                        
                       // ,
                        ])
                         
                         , ])
                        ->columnSpan(["lg" => 2]) , ])
                        ->columns(3);

                    Section::make()
                        ->schema([Textarea::make("remark")
                        ->rows(7)
                        ->label("Opmerking")
                        ->columnSpan(3)
                        ->autosize() , ]);
                }

                public static function table(Table $table) : Table
                {
                    return $table
                    
                    
                    ->groups([
                        Group::make('complexnumber')
                            ->label('Complex'),
                            Group::make('customer_id')
                            ->label('Relatie'),
                            Group::make('buildingtype.name')
                            ->label('Gebouwtype'),
                            Group::make('management_id')
                            ->label('Beheerder'),

                    ])->columns(




                        
                        [
                        
                        Tables\Columns\TextColumn::make('address')->getStateUsing(function (ObjectLocation $record) : ? string
                    {
                        $housenumber = "";
                        $complexnumber = "";
                        $name = "";
                        if($record->housenumber){
                            $housenumber = " ". $record->housenumber;
                        } 

                    

                        if ($record ?->name or $record ?->complexnumber )
                        {
                            if($record ?->complexnumber) {
                                $complexnumber = $record ?->complexnumber;
                            }

                            if($record ?->name) {
                                $name = $record ?->name;
                            }




                            return $record ?->name . " " . $complexnumber;
                        }
                        else
                        {
                            return $record->address   . " ". $housenumber . " - " . $record->zipcode . " - " . $record->place;
                        }
                    })
                        ->searchable()
                        ->label('Adres')->description(function (ObjectLocation $record)
                    {

                        $housenumber = "";
                        if($record->housenumber){
                            $housenumber = " ". $record->housenumber;
                        }
                    
 
                            return $record->address  . " ". $housenumber . " - " . $record->zipcode . "  " . $record->place ;
                 

                    }) ,

                    Tables\Columns\TextColumn::make('zipcode')
                        ->label('Postcode')
                        ->searchable()
                        ->hidden(true) ,

                    Tables\Columns\TextColumn::make('place')
                        ->label('Plaats')
                        ->searchable()
                        ->hidden(true) ,

                    TextColumn::make('objects_count')
                        ->counts('objects')
                        ->label('Objecten')
                        ->sortable()
                        ->badge()
                        ->alignment(Alignment::Center)
                        ->color('success') , TextColumn::make('notes_count')
                        ->counts('notes')
                        ->label('Notites')
                        ->sortable()
                        ->badge()
                        ->alignment(Alignment::Center)
                        ->color('success') , TextColumn::make('attachments_count')
                        ->counts('attachments')
                        ->label('Bijlages')
                        ->sortable()
                        ->badge()
                        ->alignment(Alignment::Center)
                        ->color('success') ,

                    Tables\Columns\TextColumn::make("customer.name")
                        ->sortable()
                        ->label("Relatie")
                        ->placeholder('Geen relatie gekoppeld')
                        ->searchable()->url(function (ObjectLocation $record)
                    {
                        return "/admin/customers/" . $record->customer_id . "/edit";

                    }) ,

                    Tables\Columns\TextColumn::make("managementcompany.name")
                        ->sortable()->url(function (ObjectLocation $record)
                    {
                        return "/admin/elevators-settings/object-management-companies/" . $record->management_id . "";

                    })

                        ->label("Beheerder")
                        ->placeholder('Geen beheer gekoppeld')
                        ->searchable() ,

                    Tables\Columns\TextColumn::make("buildingtype.name")
                        ->sortable()
                        ->label("Gebouwtype")
                        ->badge()
                        ->searchable()
                        ->placeholder('Onbekend') ,
                    ])
                        ->filters(array(

                        SelectFilter::make('customer_id')
                            ->options(Customer::all()
                            ->pluck('name', 'id'))
                            ->label('Relatie')
                            ->Searchable() ,

                        SelectFilter::make('building_type')
                            ->options(ObjectBuildingType::pluck('name', 'id'))
                            ->label('Gebouwtype')
                            ->Searchable(),

                        SelectFilter::make('management_id')
                            ->label('Beheerder')
                            ->relationship('managementcompany', 'name') ,

                        SelectFilter::make('place')
                            ->label('Plaats')
                            ->options(ObjectLocation::whereNotNull('place')
                            ->pluck('place', 'place'))
                            ->searchable() ,
                        Tables\Filters\TrashedFilter::make() ,
                    ))
                        ->filtersFormColumns(2)

                    // layout: FiltersLayout::AboveContent
                    // ->actions([Tables\Actions\Action::make('Download')
                    //     ->label('Toon details')
                    //     ->color('success')
                    //     ->icon('heroicon-m-eye')->url(function (ObjectLocation $record)
                    // {
                    //     return "/admin/object-locations/" . $record->id;
                    // }) ,

                    // Tables\Actions\EditAction::make() ->slideOver() 
                    //     ->label('Wijzigen')
                    // ])

                        ->bulkActions([

                    ExportBulkAction::make()
                        ->exports([
                    // Pass a string
                    ExcelExport::make()
                        ->fromTable()
                        ->askForFilename()
                        ->askForWriterType()
                        ->withColumns([Column::make('place')
                        ->heading('Plaats') , Column::make('address')
                        ->heading('Straatnaam') , Column::make('zipcode')
                        ->heading('Postcode') , Column::make('housenumber')
                        ->heading('Huisnummer') , Column::make('province')
                        ->heading('Provincie') , Column::make('gps_lon')
                        ->heading('GPS longitude') , Column::make('gps_lat')
                        ->heading('GPS latitude') , Column::make('levels')
                        ->heading('Verdiepingen') ,

                    ])
                        ->withFilename(date('m-d-Y H:i') . ' - locatie export') ,

                    ])

                    ])
                        ->emptyState(view("partials.empty-state"));
                }

                public static function getRelations() : array
                {
                    return [
                        RelationManagers\NotesRelationManager::class , RelationManagers\ObjectsRelationManager::class , RelationManagers\ProjectsRelationManager::class , RelationManagers\AttachmentsRelationManager::class ];
                }

                public static function getPages() : array
                {
                    return ['index' => Pages\ListObjectLocations::route('/') ,

                    'view' => Pages\ViewObjectLocation::route('/{record}') ,
                    // 'edit' => Pages\EditObjectLocation::route('/{record}/edit'),
                    ];
                }

                public static function getModelLabel() : string
                {
                    return "Locatie";
                }

                public static function getNavigationGroup() : ? string
                {
                    return "Hoofdmenu";
                }
            }
            
