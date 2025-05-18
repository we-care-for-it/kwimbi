<?php
namespace App\Filament\Resources;

use App\Enums\InspectionStatus;
use App\Filament\Resources\ObjectInspectionResource\Pages;
use App\Filament\Resources\ObjectInspectionResource\RelationManagers;
use App\Models\Elevator;
use App\Models\ObjectInspection;
use App\Models\Relation;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
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

    public static function shouldRegisterNavigation(): bool
    {
        return setting('use_inspections') ?? false;
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Tabs::make('Keuring Details')
                    ->columnSpan('full')
                    ->tabs([
                        Tabs\Tab::make('Algemene Informatie')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextEntry::make('elevator.nobo_no')
                                    ->label('NOBO Nummer')
                                    ->placeholder('Niet opgegeven'),
                                TextEntry::make('type')
                                    ->label('Type keuring')
                                    ->badge()
                                    ->placeholder('Niet opgegeven'),
                                TextEntry::make('status_id')
                                    ->label('Status')
                                    ->badge()
                                    ->placeholder('Niet opgegeven'),
                                TextEntry::make('executed_datetime')
                                    ->label('Uitvoerdatum')
                                    ->dateTime('d-m-Y')
                                    ->placeholder('Niet opgegeven'),
                                TextEntry::make('end_date')
                                    ->label('Einddatum')
                                    ->dateTime('d-m-Y')
                                    ->placeholder('Niet opgegeven'),
                            ])->columns(2),

                        Tabs\Tab::make('Object & Locatie')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                TextEntry::make('elevator.address')
                                    ->label('Liftadres')
                                    ->getStateUsing(function ($record): ?string {
                                        if ($record?->elevator?->nobo_no) {
                                            return $record?->elevator?->location?->address . " " .
                                            $record?->elevator?->location?->zipcode . " " .
                                            $record?->elevator?->location?->place;
                                        } else {
                                            return "Niet gekoppeld";
                                        }
                                    })
                                    ->placeholder('Geen object gevonden'),
                                TextEntry::make('elevator.maintenance_company.name')
                                    ->label('Onderhoudspartij')
                                    ->placeholder('Niet opgegeven'),
                                TextEntry::make('elevator.management_company.name')
                                    ->label('Beheerder')
                                    ->placeholder('Niet opgegeven'),
                            ])->columns(2),

                        Tabs\Tab::make('Keuring Partijen')
                            ->icon('heroicon-o-user-group')
                            ->schema([
                                TextEntry::make('inspectioncompany.name')
                                    ->label('Keuringsinstantie')
                                    ->placeholder('Niet opgegeven'),
                                TextEntry::make('inspector_name')
                                    ->label('Inspecteur')
                                    ->placeholder('Niet opgegeven'),
                                TextEntry::make('contact_person')
                                    ->label('Contactpersoon')
                                    ->placeholder('Niet opgegeven'),
                            ])->columns(2),

                        Tabs\Tab::make('Resultaten')
                            ->icon('heroicon-o-clipboard-document-check')
                            ->schema([
                                TextEntry::make('itemdata_count')
                                    ->label('Aantal punten')
                                    ->badge()
                                    ->placeholder('0'),
                                TextEntry::make('actions_count')
                                    ->label('Aantal acties')
                                    ->badge()
                                    ->placeholder('0'),
                                TextEntry::make('result')
                                    ->label('Resultaat')
                                    ->badge()
                                    ->placeholder('Niet opgegeven'),
                            ])->columns(3),

                        Tabs\Tab::make('Opmerkingen')
                            ->icon('heroicon-o-chat-bubble-bottom-center-text')
                            ->schema([
                                TextEntry::make('remark')
                                    ->label('')
                                    ->columnSpanFull()
                                    ->placeholder('Geen opmerkingen'),
                            ]),
                    ]),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(4)
                ->schema([
                    DatePicker::make("executed_datetime")
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
                        ->options([
                            "Periodieke keuring"    => "Periodieke keuring",
                            "Modernisering keuring" => "Modernisering keuring",
                            "Oplever keuring"       => "Oplever keuring",
                        ]),
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
                ->schema([
                    FileUpload::make('document')
                        ->columnSpan(1)
                        ->label('Rapportage'),
                    Textarea::make('remark')
                        ->rows(3)
                        ->label('Opmerking')
                        ->columnSpan(1)
                        ->autosize(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("elevator.nobo_no")
                    ->label("Object")
                    ->placeholder("Geen nobo nummer")
                    ->sortable()
                    ->toggleable()
                    ->wrap(),
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
                TextColumn::make("elevator.maintenance_company.name")
                    ->label("Onderhoudspartij")
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make("inspectioncompany.name")
                    ->label("Instantie")
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make("type")
                    ->label("Type keuring")
                    ->sortable(),
                TextColumn::make("status_id")
                    ->label("Status")
                    ->badge(),
                TextColumn::make("executed_datetime")
                    ->dateTime("d-m-Y")
                    ->label("Begindatum")
                    ->toggleable(),
                TextColumn::make("end_date")
                    ->dateTime("d-m-Y")
                    ->toggleable()
                    ->label("Einddatum"),
                TextColumn::make("location.customer.name")
                    ->searchable()
                    ->label("Relatie")
                    ->url(function (object $record) {
                        return "/app/customers/" . $record->customer_id . "";
                    })
                    ->icon("heroicon-c-link")
                    ->placeholder("Niet opgegeven"),
            ])
            ->filters([
                SelectFilter::make('status_id')
                    ->label("Status")
                    ->options(InspectionStatus::class),
                SelectFilter::make('inspection_company_id')
                    ->label('Keuringinstantie')
                    ->multiple()
                    ->options(Relation::where('type_id', 3)->pluck('name', 'id')),
            ], layout: FiltersLayout::AboveContent)
            ->filtersFormColumns(6)
            ->actions([
                Actions\Action::make('cancel_top')
                    ->color('gray')
                    ->tooltip('Naar Object')
                    ->label('')
                    ->color('info')
                    ->icon('heroicon-o-arrow-up-left')
                    ->url(function ($record) {
                        return "/objects/" . $record->id . "";
                    }),
                DeleteAction::make()
                    ->modalIcon('heroicon-o-trash')
                    ->tooltip('Verwijderen')
                    ->label('')
                    ->modalHeading('Contactpersoon verwijderen')
                    ->color('danger'),
            ])
            ->bulkActions([])
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
        return [
            'index'  => Pages\ListObjectInspections::route('/'),
            'create' => Pages\CreateObjectInspection::route('/create'),
            'view'   => Pages\ViewObjectInspection::route('/{record}'),
        ];
    }
}
