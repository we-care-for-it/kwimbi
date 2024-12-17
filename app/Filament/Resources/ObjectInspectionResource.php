<?php
namespace App\Filament\Resources;
use App\Models\ObjectInspectionCompany;
use App\Enums\InspectionStatus;
use App\Filament\Resources\ObjectInspectionResource\Pages;
use App\Filament\Resources\ObjectInspectionResource\RelationManagers;
use App\Models\ObjectInspection;
use App\Models\ObjectLocation;
use App\Models\Project;

use App\Models\Elevator;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Actions\Exports\ExportColumn;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Grid;

use Filament\Infolists\Components;
use Filament\Infolists\Infolist;

use Filament\Support\Enums\MaxWidth;

use Filament\Infolists\Components\TextEntry;

use Filament\Infolists\Components\RepeatableEntry;

use Illuminate\Contracts\View\View;
class ObjectInspectionResource extends Resource
{
    protected static ? string $model = ObjectInspection::class;
    protected static ?string $navigationLabel = "Keuringen";
    protected static ? string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ? string $title = "Bekijk keuring";

    public static function infolist(Infolist $infolist) : Infolist
    {

        return $infolist->schema([
        
        Components\Section::make()->schema(
            [
                
                Components\Split::make([Components\Grid::make(4)->schema([

        Components\TextEntry::make('elevator.address')
            ->label("Liftadres")->getStateUsing(function ($record) : ? string
        {

            if($record?->elevator_id){
                return $record ?->elevator ?->location ?->address . " " . $record ?->elevator ?->location ?->zipcode . " " . $record ?->elevator ?->location ?->place;
            }else{
                return "Niet gekoppeld";
            }
            
        })

        ,

        Components\TextEntry::make('elevator.nobo_no')
            ->label("NOBO Nummer") , 
 
            Components\TextEntry::make('type')
            ->badge()
            ->label("Type") ,
       

            Components\TextEntry::make('executed_datetime')
            ->label("Uitvoerdatum")
    
            ->dateTime("d-m-Y") , 
            
            Components\TextEntry::make('maintenance_company.name')
            ->label("Onderhoudspartij")
            ->placeholder("Niet opgegeven") ,

  
    
            Components\TextEntry::make('inspectioncompany.name')
            ->label("Keuringsinstantie")
            ->placeholder("Niet opgegeven"),
            Components\TextEntry::make('management_company.name')
            ->label("Beheerder")
            ->placeholder("Niet opgegeven") ,
     
            
            Components\TextEntry::make('end_date')
            ->label("Einddatum")
            ->dateTime("d-m-Y") , 
     
 
            Components\TextEntry::make('status_id')
            ->badge()
            ->label("Status")  

            , ]) ,

        ])
            ->from('lg') , ]) ,

       



        Components\Section::make()->schema(
            [
                
                Components\Split::make([
                    
       
               
                        Components\TextEntry::make('remark')
                  
                        ->label("Opmerking")  ->placeholder("Geen opmerking")
                        ])
                  
                      
                    ]) 
                
                ]);

    }

    public static function form(Form $form) : Form
    {
        return $form->schema([

        Grid::make(4)
            ->schema([DatePicker::make("executed_datetime")
            ->label("Uitvoerdatum")
            ->required() ,

        DatePicker::make("end_date")
            ->label("Einddatum")

            ->required() ,


        Select::make("status_id")
            ->label("Status")
            ->required()

            ->options(InspectionStatus::class) ,

        Select::make("type")
            ->label("Type keuring")
            ->required()

            ->options(["Periodieke keuring" => "Periodieke keuring", "Modernisering keuring" => "Modernisering keuring", "Oplever keuring" => "Oplever keuring", ]) ,

        ]) ,

        Grid::make(4)
            ->schema([


                
                
        Select::make("status_id")
        ->label("Status")
        ->required()

        ->options(InspectionStatus::class) ,



        Select::make("elevator_id")
            ->label("NoBo Nummer")
            ->required()
            ->options(Elevator::whereNot('nobo_no',NULL)->pluck('nobo_no', 'id'))
            ->searchable(),
             
        Select::make("inspection_company_id")
            ->label("Keuringsinstantie")
            ->required()

            ->options(ObjectInspectionCompany::pluck("name", "id")) ,

        ]) ,

        Grid::make(2)
            ->schema([FileUpload::make('document')
            ->columnSpan(1)

            ->label('Rapportage')

        ,

        Textarea::make('remark')
            ->rows(3)
            ->label('Opmerking')
            ->columnSpan(1)
            ->autosize() ])

        ]) ;

    }


    public static function table(Table $table) : Table
    {
        return $table

    ->groups([Group::make('status_id')
            ->label('Status') ,
        Group::make('elevator.location_id')
            ->label('Locatie') ,

        Group::make('elevator.location.customer.id')
            ->label('Relatie') ,

        Group::make('elevator.maintenance_company_id')
            ->label('Onderhoudspartij'),
        ])
    ->columns([



        Tables\Columns\TextColumn::make("elevator.nobo_no")
            ->label("Object")
            ->placeholder("Geen object")
            ->sortable()
            ->wrap() ,

        Tables\Columns\TextColumn::make('elevator.location')
            ->label('Adres')
            ->searchable()
            ->sortable()
            ->wrap()
            ->placeholder("Geen object")
            ->getStateUsing(function (ObjectInspection $record) : ? string
                {
                    if($record?->elevator_id){
                        return $record ?->elevator ?->location ?->address . "," . $record ?->elevator ?->location ?->zipcode . "," . $record ?->elevator ?->location ?->place;
                    }else{
                        return "-";
                    }
                })


    ->description(function (ObjectInspection $record) : ? string
        {
           
                return $record ?->elevator ?->location ?->zipcode . "   " . $record ?->elevator ?->location ?->place;
     
        }),
    

        Tables\Columns\TextColumn::make("executed_datetime")
            ->dateTime("d-m-Y")
            ->label("Begindatum")
            ->sortable(),

        Tables\Columns\TextColumn::make("end_date")
            ->dateTime("d-m-Y")
            ->label("Einddatum")
            ->sortable(),

        Tables\Columns\TextColumn::make("type")
            ->label("Type keuring")
            ->sortable() ,

        Tables\Columns\TextColumn::make('itemdata_count')
            ->counts('itemdata')
            ->label("Aantal punten")
            ->alignment('center')
            ->badge() ,

        Tables\Columns\TextColumn::make("inspectioncompany.name")
            ->label("Onderhoudspartij")
            ->sortable(),

        Tables\Columns\TextColumn::make("status_id")
            ->label("Status")
            ->badge()
            ->sortable() ,

        ])
    
        ->filters([

        SelectFilter::make('status_id')
            ->options(InspectionStatus::class)
            ->label("Status") ,
        

        ])
            ->filtersFormColumns(2)
            //->actions([

        // Tables\Actions\EditAction::make()
        //     ->label("Meer details") ])

        //     ->recordUrl(function ($record) {
        //         return "/admin/object-inspections/" . $record->id;
        //     })

            
            ->bulkActions([Tables\Actions\BulkActionGroup::make([
        //  ExportBulkAction::make(),
        ]) , ])        ->emptyState(view('partials.empty-state'));
    }

    public static function getRelations() : array
    {
        return [RelationManagers\ItemdataRelationManager::class ,

        ];
    }

    public static function getPages() : array
    {
        return ['index' => Pages\ListObjectInspections::route('/') , 'create' => Pages\CreateObjectInspection::route('/create') , 'edit' => Pages\EditObjectInspection::route('/{record}/edit') , 
        
        'view' => Pages\ViewObjectInspection::route('/{record}') , ];
    }
}

