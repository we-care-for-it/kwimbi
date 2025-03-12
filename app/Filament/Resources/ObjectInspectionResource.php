<?php
namespace App\Filament\Resources;

use App\Enums\InspectionStatus;
use App\Filament\Resources\ObjectInspectionResource\Pages;
use App\Filament\Resources\ObjectInspectionResource\RelationManagers;
use App\Models\Elevator;
use App\Models\ObjectInspection;
use App\Models\Relation;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Actions;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;

class ObjectInspectionResource extends Resource
{
    protected static ?string $model            = ObjectInspection::class;
    protected static ?string $navigationLabel  = "Keuringen";
    protected static ?string $navigationIcon   = 'heroicon-m-check-badge';
    protected static ?string $modelLabel       = 'Keuring';
    protected static ?string $pluralModelLabel = 'Keuringen';
    protected static ?string $navigationGroup  = 'Objecten';
    protected static ?int $navigationSort      = 4;

    public static function infolist(Infolist $infolist): Infolist
    {

        return $infolist->schema([

            Components\Section::make()->schema(
                [

                    Components\Split::make([Components\Grid::make(4)->schema([

                        Components\TextEntry::make('elevator.address')
                            ->label("Liftadres")->getStateUsing(function ($record): ?string {

                            if ($record?->elevator?->nobo_no) {
                                return $record?->elevator?->location?->address . " " . $record?->elevator?->location?->zipcode . " " . $record?->elevator?->location?->place;
                            } else {
                                return "Niet gekoppeld";
                            }

                        })->placeholder('Geen object gevonden')

                        ,

                        Components\TextEntry::make('nobo_number')
                            ->label("NOBO Nummer"),

                        Components\TextEntry::make('type')
                            ->badge()
                            ->label("Type"),

                        Components\TextEntry::make('executed_datetime')
                            ->label("Uitvoerdatum")

                            ->dateTime("d-m-Y"),

                        Components\TextEntry::make('maintenance_company.name')
                            ->label("Onderhoudspartij")
                            ->placeholder("Niet opgegeven"),

                        Components\TextEntry::make('inspectioncompany.name')
                            ->label("Keuringsinstantie")
                            ->placeholder("Niet opgegeven"),
                        Components\TextEntry::make('management_company.name')
                            ->label("Beheerder")
                            ->placeholder("Niet opgegeven"),

                        Components\TextEntry::make('end_date')
                            ->label("Einddatum")
                            ->dateTime("d-m-Y"),

                        Components\TextEntry::make('status_id')
                            ->badge()
                            ->label("Status"),

                    ]),

                    ])
                        ->from('lg')]),

            Components\Section::make()->schema(
                [

                    Components\Split::make([

                        Components\TextEntry::make('remark')

                            ->label("Opmerking")->placeholder("Geen opmerking"),
                    ]),

                ]),

        ]);

    }

    public static function form(Form $form): Form
    {
        return $form->schema([

            Grid::make(4)
                ->schema([DatePicker::make("executed_datetime")
                        ->label("Uitvoerdatum")
                        ->required(),

                    DatePicker::make("end_date")
                        ->label("Einddatum")

                        ->required(),

                    Select::make("status_id")
                        ->searchable()
                        ->label("Status")
                        ->required()

                        ->options(InspectionStatus::class),

                    Select::make("type")
                        ->label("Type keuring")
                        ->searchable()
                        ->options(["Periodieke keuring" => "Periodieke keuring", "Modernisering keuring" => "Modernisering keuring", "Oplever keuring" => "Oplever keuring"]),

                ]),

            Grid::make(4)
                ->schema([

                    Select::make("elevator_id")
                        ->label("NoBo Nummer")
                        ->required()
                        ->options(Elevator::whereNot('nobo_no', null)->pluck('nobo_no', 'id'))
                        ->searchable(),

                    Select::make("inspection_company_id")
                        ->label("Keuringsinstantie")
                        ->required()
                        ->options(Relation::where('type_id', 3)->pluck("name", "id")),
                ]),

            Grid::make(2)
                ->schema([FileUpload::make('document')
                        ->columnSpan(1)

                        ->label('Rapportage')

                    ,

                    Textarea::make('remark')
                        ->rows(3)
                        ->label('Opmerking')

                        ->columnSpan(1)
                        ->autosize()]),

        ]);

    }

    public static function table(Table $table): Table
    {

        // ->query(

        //     Elevator::query()
        // )

        // ->groups([Group::make('status_id')
        //         ->label('Status') ,

        //     Tables\Columns\TextColumn::make('elevator.location.address')
        //         ->label('Adres')
        //         ->searchable()
        //         ->sortable()
        //         ->toggleable()
        //         ->wrap()
        //         ->placeholder("Geen object")
        //         ->getStateUsing(function (ObjectInspection $record): ?string {
        //             if ($record?->elevator_id) {
        //                 return $record?->elevator?->location?->address . "," . $record?->elevator?->location?->zipcode . "," . $record?->elevator?->location?->place;
        //             } else {
        //                 return "-";
        //             }
        //         })

        //         ->description(function (ObjectInspection $record): ?string {

        //             return $record?->elevator?->location?->zipcode . "   " . $record?->elevator?->location?->place;

        //         }),

        //         ->sortable(),

        //     Tables\Columns\TextColumn::make("status_id")
        //         ->label("Status")
        //         ->badge()
        //         ->toggleable()
        //         ->sortable(),

        // ])
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("elevator.nobo_no")
                    ->label("Object")
                    ->placeholder("Geen nobo nummer")
                    ->sortable()
                    ->toggleable()
                    ->wrap(),

                // Tables\Columns\TextColumn::make("location")
                //     ->getStateUsing(function (Elevator $record): ?string {
                //         if ($record?->location->name) {
                //             return $record?->location->name;
                //         } else {
                //             return $record->location->address .
                //             " - " .
                //             $record->location->zipcode .
                //             " " .
                //             $record->location->place;
                //         }
                //     })
                //     ->label("Locatie")
                //     ->description(function (Elevator $record) {
                //         if (! $record?->location->name) {
                //             return $record?->location->name;
                //         } else {
                //             return $record->location->address .
                //             " - " .
                //             $record->location->zipcode .
                //             " " .
                //             $record->location->place;
                //         }
                //     }),

                Tables\Columns\TextColumn::make("zipcode")
                    ->label("Postcode")
                    ->searchable()
                    ->hidden(true),
                Tables\Columns\TextColumn::make("place")
                    ->label("Plaats")
                    ->searchable()
                    ->hidden(true),

                TextColumn::make("itemdata_count")
                    ->counts("itemdata")
                    ->label("Punten")
                    ->toggleable()
                    ->sortable()
                    ->badge()
                    ->alignment(Alignment::Center)
                    ->color("success"),

                TextColumn::make("actions_count")
                    ->counts("actions")
                    ->label("Acties")
                    ->toggleable()
                    ->sortable()
                    ->badge()
                    ->alignment(Alignment::Center)
                    ->color("success"),

                Tables\Columns\TextColumn::make("address")
                    ->label("Adres")
                    ->searchable()

                    ->hidden(true),

                Tables\Columns\TextColumn::make("elevator.maintenance_company.name")
                    ->label("Onderhoudspartij")
                    ->searchable()
                    ->toggleable()
                    ->sortable(),

                Tables\Columns\TextColumn::make("inspectioncompany.name")
                    ->label("Instantie")
                    ->searchable()
                    ->toggleable()
                    ->sortable(),

                Tables\Columns\TextColumn::make("type")
                    ->label("Type keuring")
                    ->sortable(),

                Tables\Columns\TextColumn::make("status_id")
                    ->label("Status")
                    ->badge(),
                Tables\Columns\TextColumn::make("executed_datetime")
                    ->dateTime("d-m-Y")
                    ->label("Begindatum")
                    ->toggleable(),
                //     ->sortable(),
                // TextColumn::make("sasd")
                //     ->counts("latestInspection.itemdata")
                //     ->label("Punten")
                //     ->badge()
                //     ->alignment('center')
                //     ->color("success"),
                Tables\Columns\TextColumn::make("end_date")
                    ->dateTime("d-m-Y")
                    ->toggleable()
                    ->label("Einddatum"),

                Tables\Columns\TextColumn::make("location.customer.name")
                    ->searchable()
                    ->label("Relatie")->Url(function (object $record) {
                    return "/app/customers/" . $record->customer_id . "";
                })
                    ->icon("heroicon-c-link")
                    ->placeholder("Niet opgegeven"),
            ])
            //     ->recordUrl(function ($record) {
            //     return "/admin/object-inspections/" . $record->id;
            // }

            ->filters([

                SelectFilter::make('status_id')
                    ->label("Status")
                    ->options(InspectionStatus::class),

                SelectFilter::make('inspection_company_id')
                    ->label('Keuringinstantie')
                    ->multiple()
                    ->options(Relation::where('type_id', 3)->pluck('name', 'id')),

                // SelectFilter::make('elevator.maintenance_company_id')
                //     ->label('Onderhoudspartij')
                //     ->multiple()
                //     ->options(Relation::where('type_id', 2)->pluck('name', 'id')),

                // Filter::make('TypeFilter')
                //     ->form([
                //         Select::make('status_id')
                //             ->label("Type")
                //             ->options(InspectionTypes::class),

                //     ])->query(function (Builder $query, array $data): Builder {
                //     return $query

                //         ->when(
                //             $data['status_id'],
                //             fn(Builder $query, $status_id): Builder =>
                //             $query->whereHas('latestInspection', fn($subQuery) => $subQuery
                //                     ->where('status_id', $status_id)
                //             )

                //         );

                // }),

                // Filter::make('TypeFilter')
                //     ->form([
                //         Select::make("type_id")
                //             ->label("Type keuring")
                //             ->options(["Periodieke keuring" => "Periodieke keuring", "Modernisering keuring" => "Modernisering keuring", "Oplever keuring" => "Oplever keuring"]),

                //     ])->query(function (Builder $query, array $data): Builder {
                //     return $query

                //         ->when(
                //             $data['type_id'],
                //             fn(Builder $query, $type_id): Builder =>
                //             $query->whereHas('latestInspection', fn($subQuery) => $subQuery
                //                     ->where('type', $type_id)
                //                     ->whereColumn('id', DB::raw('(SELECT id FROM object_inspections WHERE object_inspections.elevator_id = elevators.id and deleted_at is null ORDER BY end_date DESC LIMIT 1)'))

                //             )

                //         )

                //         // ->when(
                //         //     $data['maintenance_company_id'],
                //         //     fn(Builder $query, $maintenance_company_id): Builder =>
                //         //     $query->whereHas('latestInspection', fn($subQuery) => $subQuery
                //         //             ->where('maintenance_company_id', $maintenance_company_id)
                //         //     )

                //         // )

                //     ;

                //     ;

                //   }),

                // Filter::make('MaintenanceFilter')
                //     ->form([

                //         Select::make("maintenance_company_id")
                //             ->label("Onderhoudspartij")
                //             ->searchable()
                //             ->options(Company::where('type_id', 1)->pluck("name", "id")),

                //     ])->query(function (Builder $query, array $data): Builder {
                //     return $query

                //         ->when(
                //             $data['maintenance_company_id'],
                //             fn(Builder $query, $maintenance_company_id): Builder =>
                //             $query->whereHas('latestInspection', fn($subQuery) => $subQuery
                //                     ->where('maintenance_company_id', $maintenance_company_id)
                //                     ->whereColumn('id', DB::raw('(SELECT id FROM object_inspections WHERE object_inspections.elevator_id = elevators.id and deleted_at is null ORDER BY end_date DESC LIMIT 1)'))

                //             )

                //         )

                //         // ->when(
                //         //     $data['maintenance_company_id'],
                //         //     fn(Builder $query, $maintenance_company_id): Builder =>
                //         //     $query->whereHas('latestInspection', fn($subQuery) => $subQuery
                //         //             ->where('maintenance_company_id', $maintenance_company_id)
                //         //     )

                //         // )

                //     ;

                //     ;

                // }),

            ], layout: FiltersLayout::AboveContent)->filtersFormColumns(6)

            //->actions([

            // Tables\Actions\EditAction::make()
            //     ->label("Meer details") ])

            ->actions([

                // EditAction::make()
                //     ->modalHeading('Snel bewerken')
                //     ->modalIcon('heroicon-o-pencil')
                //     ->hidden(fn($record) => $record->external_uuid)
                //     ->label('Bewerken')
                //     ->slideOver(),

                // Actions\Action::make("Downloaddocument")->color("warning")
                //     ->label("Download rapport")
                //     ->icon("heroicon-o-document-arrow-down")
                //     ->link()
                //     ->fillForm(
                //         fn($record): array=> [
                //             "filename" =>
                //             $record->status_id->getlabel() .
                //             " - Report - " .
                //             $record?->elevator?->location?->address .
                //             ", " .
                //             $record?->elevator?->location?->place,
                //         ]
                //     )->action(function ($data, $record) {
                //     $contents = base64_decode($record->document);
                //     $path     = public_path($data["filename"] . ".pdf");

                //     file_put_contents($path, $contents);

                //     return response()
                //         ->download($path)
                //         ->deleteFileAfterSend(true);
                // }),

                Actions\Action::make('cancel_top')

                    ->color('gray')
                    ->tooltip('Naar Object')
                    ->label('')
                    ->color('info')
                    ->icon('heroicon-o-arrow-up-left')
                    ->url(function ($record) {
                        return "/" . Filament::getTenant()->id . "/objects/" . $record->id . "";

                    }),
                DeleteAction::make()
                    ->modalIcon('heroicon-o-trash')
                    ->tooltip('Verwijderen')
                    ->label('')
                    ->modalHeading('Contactpersoon verwijderen')
                    ->color('danger'),
            ])

            ->bulkActions([

                //    ExportBulkAction::make()
                //     ->exports([
                //         ExcelExport::make()
                //             ->fromTable()
                //         // ->askForFilename()
                //         //->askForWriterType()

                //             ->withFilename(date("m-d-Y H:i") . " - objecten export")])

            ])
            ->emptyState(view('partials.empty-state'));
    }

    public static function getRelations(): array
    {
        return [

            RelationManagers\ItemdataRelationManager::class,
            RelationManagers\ActionsRelationManager::class,

        ];
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListObjectInspections::route('/'),
            'create'        => Pages\CreateObjectInspection::route('/create'),
            'view'          => Pages\ViewObjectInspection::route('/{record}')];
    }

}
