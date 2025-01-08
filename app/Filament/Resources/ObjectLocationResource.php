<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ObjectLocationResource\Pages;
use App\Filament\Resources\ObjectLocationResource\RelationManagers;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\Resource;

use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;
use Filament\Actions\Exports\Models\Export;

 
use App\Models\Customer;
use App\Models\ObjectLocation;
use App\Models\ObjectBuildingType;
 
use App\Models\Project;
use App\Models\Company;
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

use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\MaxWidth;

use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;

use Filament\Tables\Grouping\Group;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;



class ObjectLocationResource extends Resource
{
    protected static ? string $model = ObjectLocation::class;
    protected static ? string $navigationIcon = "heroicon-o-building-office-2";
    protected static ? string $navigationLabel = "Locaties";



    public static function infolist(Infolist $infolist) : Infolist
    {
        return $infolist->schema([Section::make()->schema([Components\Split::make([
            
            Components\Grid::make(4)->schema([
                
                TextEntry::make("address")

            ->label("Adres")->getStateUsing(function (ObjectLocation $record) : ? string
        {
            $housenumber = "";
            if ($record->housenumber)
            {
                $housenumber = " " . $record?->housenumber;
            }

            return $record?->address . " " . $housenumber . " - " . $record?->zipcode . " " . $record?->place;
        })
            ->placeholder("Niet opgegeven")
            
            ->Url(function (object $record)
                        {
                            return "https://www.google.com/maps/dir/".$record?->address."+". $record?->housenumber."+".$record?->zipcode."+" . $record?->place ;
                        })
                        ->icon('heroicon-s-map-pin')
                        ->openUrlInNewTab()
 
                            ,

        TextEntry::make("name")
            ->label("Complexnaam")
            ->placeholder("Niet opgegeven") ,

        TextEntry::make("construction_year")
            ->label("Bouwjaar")
            ->placeholder("Niet opgegeven") ,

        TextEntry::make("customer.name")
            ->label("Relatie")->Url(function (object $record)
        {
            return "/admin/customers/" . $record->customer_id . "";
        })
            ->icon("heroicon-c-link")
            ->placeholder("Niet opgegeven") ,

        TextEntry::make("buildingtype.name")
            ->label("Gebouwtype")
            ->badge()
            ->placeholder("Niet opgegeven") ,

        TextEntry::make("complexnumber")
            ->label("Complexnummer")
            ->placeholder("Niet opgegeven") ,

        TextEntry::make("province")
            ->label("Provincie")
            ->placeholder("Niet opgegeven") ,

        TextEntry::make("managementcompany.name")
            ->label("Beheerder")
            ->placeholder("Niet opgegeven") , ]) , ]) , ]) , ]);
    }

    public static function getGloballySearchableAttributes() : array
    {
        return ["name", "address"];
    }


    
    public static function getGlobalSearchResultDetails($record) : array
    {

        
        return [
            'Naam' => $record->address . "   " . $record?->housenumber .  " " . $record?->place,
            'Beheerder' => $record?->managementcompany->name ?? "-",
        ];


        
    }

    public static function form(Form $form) : Form
    {
        return $form->schema([Forms\Components\Section::make()
            ->schema([Grid::make(2)
            ->schema([Forms\Components\TextInput::make("name")
            ->label("Naam") ,

        Forms\Components\TextInput::make("complexnumber")
            ->label("Complexnumber") ,

        Select::make("management_id")
        ->options(Company::where('type_id',2)->pluck("name", "id"))

                ->searchable()
                ->label("Beheerder")
                ->preload()  ,

            Select::make("customer_id")
                ->searchable()
                ->label("Relatie")
                ->preload()
                ->required()
                ->createOptionForm([Forms\Components\TextInput::make("name")
                ->required()
                ->label("Naam van de relatie") , ])
                ->relationship(name:
                "customer", titleAttribute:
                    "name") , ]) , ]) ,

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

                            $set("place", $data ?->municipality);
                            $set("gps_lat", $data ?->lat);
                            $set("gps_lon", $data ?->lng);
                            $set("address", $data ?->street);
                            $set("municipality", $data ?->municipality);
                            $set("province", $data ?->province);
                            $set("place", $data ?->settlement);
    
                            $set("construction_year", $data ?->constructionYear);
                            $set("surface", $data ?->surfaceArea);
                            
                            //check building type ifexist
                            $buildTypeExist = ObjectBuildingType::where('name', '=', $data?->purposes[0])->first();
                            if ($buildTypeExist === null) {
                                $buildingTypeId = ObjectBuildingType::insertGetId(['name'=>ucfirst($data?->purposes[0])]);
                              
                         
                            }else{
                                $buildingTypeId  =  $buildTypeExist->id;
                            }

                            $set("building_type_id", $buildingTypeId);
                    

                        }
                    }))->reactive(),     


                    Forms\Components\TextInput::make("address")
                        ->label("Straatnaam")
                        ->required()
                        ->columnSpan(2) ,

                    Forms\Components\TextInput::make("housenumber")
                        ->label("Huisnummer") , Forms\Components\TextInput::make("place")
                        ->label("Plaats") , Forms\Components\TextInput::make("province")
                        ->label("Provincie") , Forms\Components\TextInput::make("gps_lat")
                        ->label("GPS latitude")

                        ->columnSpan(1)
                        ->hidden() , Forms\Components\TextInput::make("gps_lon")
                        ->label("GPS longitude")
                        ->hidden()
                        ->columnSpan(1) ,
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
                        ->options(ObjectBuildingType::pluck("name", "id"))
                  
                        ->reactive()
                        ->searchable()
                    

                        ->label("Gebouwtype")
                        ->columnSpan(3) ,

                    // ,
                    ]) , ])
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
                    ->groups([Group::make("complexnumber")
                        ->label("Complex") , Group::make("customer_id")
                        ->label("Relatie") , Group::make("buildingtype.name")
                        ->label("Gebouwtype") , Group::make("management_id")
                        ->label("Beheerder") , ])->columns(
                            
                            [
                                
                                Tables\Columns\TextColumn::make("address")
                        ->toggleable()
                        
                        ->getStateUsing(function (ObjectLocation $record) : ? string
                    {
                        $housenumber = "";
                        $complexnumber = "";
                        $name = "";
                        if ($record->housenumber)
                        {
                            $housenumber = " " . $record->housenumber;
                        }

                        // if ($record ?->name or $record ?->complexnumber)
                        // {
                    

                           

                        //     return $record ?->name . " " . $complexnumber;
                        // }
                        // else
                        // {
                            return $record->address . " " . $housenumber . " - " . $record->zipcode . " - " . $record->place;
                       // }
                    })
                        ->searchable()
                        ->label("Adres")->description(function (ObjectLocation $record)
                    {
                        
                        $complexnumber = NULL;
                        if ($record ?->complexnumber)
                        {
                            $complexnumber = $record ?->complexnumber;
                        }

                        $name = NULL;
                        if ($record ?->name)
                        {
                            $name = $record ?->name;
                        }   
                    
                        return $name . " " . $complexnumber;
           
                    
                    
                    
                    
                    
                    
                    }) ,

                    Tables\Columns\TextColumn::make("zipcode")
                        ->label("Postcode")
                        ->searchable()
                        ->toggleable()
                        ->hidden(true) , Tables\Columns\TextColumn::make("place")
                        ->label("Plaats")
                        ->searchable()
                        ->toggleable()
                        ->hidden(true) , TextColumn::make("objects_count")
                        ->counts("objects")
                        ->label("Objecten")
                        ->toggleable()
                        ->sortable()
                        ->badge()
                        ->alignment(Alignment::Center)
                        ->color("success") , TextColumn::make("notes_count")
                        ->toggleable()
                        ->counts("notes")
                        ->label("Notites")
                        ->sortable()
                        ->badge()
                        ->alignment(Alignment::Center)
                        ->color("success") , TextColumn::make("attachments_count")
                        ->toggleable()
                        ->counts("attachments")
                        ->label("Bijlages")
                        ->sortable()
                        ->badge()
                        ->alignment(Alignment::Center)
                        ->toggleable()
                        ->color("success") , Tables\Columns\TextColumn::make("customer.name")
                        ->toggleable()
                        ->sortable()
                        ->label("Relatie")
                        ->placeholder("Geen relatie gekoppeld")
                        ->searchable()->url(function (ObjectLocation $record)
                    {
                        return "/admin/customers/" . $record->customer_id . "/edit";
                    }) ,

                    Tables\Columns\TextColumn::make("managementcompany.name")
                        ->toggleable()
                        ->sortable()->url(function (ObjectLocation $record)
                    {
                        return "/admin/companies/" . $record->management_id . "";        })

                        ->label("Beheerder")
                        ->placeholder("Geen beheer gekoppeld")
                        ->searchable() ,

                    Tables\Columns\TextColumn::make("buildingtype.name")
                        ->toggleable()
                        ->sortable()
                        ->label("Gebouwtype")
                        ->badge()
                        ->searchable()
                        ->placeholder("Onbekend") , ])

                        ->filters([SelectFilter::make("customer_id")
                        ->options(Customer::all()
                        ->pluck("name", "id"))
                        ->label("Relatie")

                        ->Searchable() ,

                    SelectFilter::make("building_type")
                        ->options(ObjectBuildingType::pluck("name", "id"))
                        ->label("Gebouwtype")
                        ->preload()
                        ->Searchable() ,

                    SelectFilter::make("management_id")
                        ->label("Beheerder")
                        ->options(Company::where('type_id',2)->pluck("name", "id")),

                    SelectFilter::make("place")
                        ->label("Plaats")
                        ->options(ObjectLocation::whereNotNull("place")
                        ->pluck("place", "place"))
                        ->searchable() ,
                        Tables\Filters\TrashedFilter::make() , ], //layout : FiltersLayout::AboveContent
                        )

                        ->actions([ActionGroup::make([
 
                            
                            EditAction::make()
                            ->modalHeading('Locatie snel bewerken')
                            ->modalIcon('heroicon-o-pencil')
                            ->label('Snel bewerken')
                            ->slideOver(),   DeleteAction::make() , ]) , ])
                        ->bulkActions([ExportBulkAction::make()
                        ->exports([
                            ExcelExport::make()
                        ->fromTable()
                        ->askForFilename()
                        ->askForWriterType()
                        ->withColumns([Column::make("place")
                        ->heading("Plaats") , Column::make("address")
                        ->heading("Straatnaam") , Column::make("zipcode")
                        ->heading("Postcode") , Column::make("housenumber")
                        ->heading("Huisnummer") , Column::make("province")
                        ->heading("Provincie") , Column::make("gps_lon")
                        ->heading("GPS longitude") , Column::make("gps_lat")
                        ->heading("GPS latitude") , Column::make("levels")
                        ->heading("Verdiepingen") , ])
                        ->withFilename(date("m-d-Y H:i") . " - locatie export") , ]) , ])
                        ->emptyState(view("partials.empty-state"));
                }

                public static function getRelations() : array
                {
                    return [
                        RelationManagers\ObjectsRelationManager::class ,
                    RelationManagers\NotesRelationManager::class , 
                    RelationManagers\ProjectsRelationManager::class , 
                    RelationManagers\AttachmentsRelationManager::class , ];
                }

                public static function getPages() : array
                {
                    return 
                    ["index" => Pages\ListObjectLocations::route("/") ,
                     "view" => Pages\ViewObjectLocation::route("/{record}") , ];
                }

                public static function getModelLabel() : string
                {
                    return "Locatie";
                }
             
            }
            
