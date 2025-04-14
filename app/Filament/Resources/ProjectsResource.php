<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ProjectsResource\Pages;
use App\Filament\Resources\ProjectsResource\RelationManagers;
use App\Models\ObjectLocation;
use App\Models\Project;
use App\Models\Relation;
use App\Models\Statuses;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\VerticalAlignment;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ProjectsResource extends Resource
{
    protected static ?string $model             = Project::class;
    protected static ?string $title             = "Projecten";
    protected static ?string $SearchResultTitle = "Projecten";
    protected static ?string $navigationLabel   = "Projecten";
    protected static ?string $navigationIcon    = "heroicon-o-archive-box";
    protected static bool $isLazy               = false;
    protected static ?int $navigationSort       = 90;
    protected static ?string $pluralModelLabel  = 'Projecten';

    protected $listeners = ["refresh" => '$refresh'];
    private null $id;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Grid::make([
                            "default" => 2,
                            "sm"      => 2,
                            "md"      => 2,
                            "lg"      => 2,
                            "xl"      => 2,
                            "2xl"     => 2,
                        ])->schema([
                            Forms\Components\TextInput::make("name")
                                ->label("Omschrijving")
                                ->maxLength(255)
                                ->required()
                                ->columnSpan("full"),
                            TextInput::make("description")
                                ->label("Opmerking")
                                ->columnSpan("full"),
                        ]),
                    ])
                    ->columnSpan(["lg" => 2]),

                Section::make()
                    ->schema([
                        Grid::make([
                            "default" => 2,
                            "sm"      => 2,
                            "md"      => 2,
                            "lg"      => 2,
                            "xl"      => 2,
                            "2xl"     => 2,
                        ])->schema([
                            TextInput::make("budget_costs")
                                ->label("Budget")
                                ->suffixIcon("heroicon-o-currency-euro")
                                ->columnSpan("full"),
                            Select::make("status_id")
                                ->label("Status")
                                ->reactive()
                                ->options(["1" => "Open"])
                                ->columnSpan("full")
                                ->default(1),
                        ]),
                    ])->columnSpan(1),

                Section::make()
                    ->schema([
                        Select::make("customer_id")
                            ->searchable()
                            ->label("Relatie")
                            ->columnSpan("full")
                            ->options(Relation::all()->pluck("name", "id")),
                        Select::make("location_id")
                            ->searchable()
                            ->label("Locatie")
                            ->columnSpan("full")
                            ->options(ObjectLocation::all()->pluck("address", "id")),
                    ])
                    ->columns(2)
                    ->columnSpan(1),

                Section::make()
                    ->schema([
                        Grid::make([
                            "default" => 2,
                            "sm"      => 2,
                            "md"      => 2,
                            "lg"      => 2,
                            "xl"      => 2,
                            "2xl"     => 2,
                        ])->schema([
                            DatePicker::make("requestdate")->label("Aanvraagdatum"),
                            DatePicker::make("date_of_execution")
                                ->label("Plandatum")
                                ->placeholder('Onbekend'),
                            DatePicker::make("startdate")->label("Startdatum"),
                            DatePicker::make("enddate")->label("Einddatum"),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                Group::make("customer.name")
                    ->label("Relatie")
                    ->titlePrefixedWithLabel(false),
                Group::make("status.name")
                    ->label("Status")
                    ->titlePrefixedWithLabel(false)
                    ->getKeyFromRecordUsing(fn(Project $record): string => $record->status->name),
            ])
            ->defaultGroup("customer.name")
            ->columns([
                Tables\Columns\TextColumn::make("id")
                    ->label("#")
                    ->getStateUsing(function (Project $record): ?string {
                        return sprintf("%05d", $record?->id);
                    })
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->verticalAlignment(VerticalAlignment::Start),

                Tables\Columns\TextColumn::make("name")
                    ->label("Omschrijving")
                    ->searchable()
                    ->wrap()
                    ->description(function (Project $record) {
                        if (! $record?->description) {
                            return false;
                        } else {
                            return $record->description;
                        }
                    })
                    ->verticalAlignment(VerticalAlignment::Start),

                Tables\Columns\TextColumn::make("customer.name")
                    ->getStateUsing(function (Project $record): ?string {
                        return $record?->customer->name;
                    })
                    ->url(function (Project $record) {
                        return "/relations/" . $record->customer_id;
                    })
                    ->color('primary')
                    ->searchable()
                    ->sortable()
                    ->verticalAlignment(VerticalAlignment::Start)
                    ->label("Adres")
                    ->description(function (Project $record) {
                        if (! $record?->location_id) {
                            return "Geen locatie gekoppeld";
                        } else {
                            return $record->location?->address . " - " . $record->location?->zipcode . "  " . $record->location?->place;
                        }
                    }),

                Tables\Columns\TextColumn::make("startdate")
                    ->label("Looptijd")
                    ->getStateUsing(function (Project $record): ?string {
                        $startdate = $record->startdate ? date("d-m-Y", strtotime($record?->startdate)) : "nodate";
                        $enddate   = $record->enddate ? date("d-m-Y", strtotime($record?->enddate)) : "nodate";

                        if ($record->enddate || $record->$startdate) {
                            return $startdate . " - " . $enddate;
                        } else {
                            return "";
                        }
                    })
                    ->placeholder('Onbekend')
                    ->searchable(),

                Tables\Columns\TextColumn::make("date_of_execution")
                    ->label("Plandatum")
                    ->getStateUsing(function (Project $record): ?string {
                        if ($record->date_of_execution) {
                            return date("d-m-Y", strtotime($record?->date_of_execution));
                        } else {
                            return false;
                        }
                    })
                    ->placeholder('Onbekend')
                    ->searchable()
                    ->color(fn($record) => strtotime($record?->date_of_execution) < time() ? "danger" : "success"),

                Tables\Columns\TextColumn::make("status.name")
                    ->label("Status")
                    ->sortable()
                    ->badge(),

                Tables\Columns\TextColumn::make('quotes_count')
                    ->counts('quotes')
                    ->badge()
                    ->sortable()
                    ->label("Offertes")
                    ->alignment('center'),

                Tables\Columns\TextColumn::make('reactions_count')
                    ->counts('reactions')
                    ->badge()
                    ->label("Reacties")
                    ->alignment('center'),
            ])
            ->filters([
                SelectFilter::make("status_id")
                    ->label("Status")
                    ->options(Statuses::where("model", "Project")->pluck("name", "id"))
                    ->searchable()
                    ->preload(),
                SelectFilter::make("customer_id")
                    ->label("Relatie")
                    ->options(Relation::get()->pluck("name", "id"))
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Project Bewerken')
                    ->modalDescription('Pas de bestaande project aan door de onderstaande gegevens zo volledig mogelijk in te vullen.')
                    ->tooltip('Bewerken')
                    ->label('Bewerken')
                    ->modalIcon('heroicon-o-pencil')
                    ->slideOver(),
                DeleteAction::make()
                    ->modalIcon('heroicon-o-trash')
                    ->tooltip('Verwijderen')
                    ->label('')
                    ->modalHeading('Verwijderen')
                    ->color('danger'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make(),
                ]),
            ])
            ->emptyState(view("partials.empty-state"));
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Tabs::make('Project Details')
                    ->columnSpan('full')
                    ->tabs([
                        Tabs\Tab::make('Algemene Informatie')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Omschrijving')
                                    ->placeholder('-'),
                                TextEntry::make('description')
                                    ->label('Opmerkingen')
                                    ->placeholder('-')
                                    ->columnSpanFull(),
                                TextEntry::make('status.name')
                                    ->label('Status')
                                    ->badge()
                                    ->placeholder('-'),
                                TextEntry::make('budget_costs')
                                    ->label('Budget')
                                    ->money('EUR')
                                    ->placeholder('-'),
                            ])->columns(2),

                        Tabs\Tab::make('Relatie & Locatie')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                TextEntry::make('customer.name')
                                    ->label('Relatie')
                                    ->placeholder('-'),
                                TextEntry::make('location.address')
                                    ->label('Adres')
                                    ->placeholder('-'),
                                TextEntry::make('location.zipcode')
                                    ->label('Postcode')
                                    ->placeholder('-'),
                                TextEntry::make('location.place')
                                    ->label('Plaats')
                                    ->placeholder('-'),
                            ])->columns(2),

                        Tabs\Tab::make('Planning')
                            ->icon('heroicon-o-calendar')
                            ->schema([
                                TextEntry::make('requestdate')
                                    ->label('Aanvraagdatum')
                                    ->date('d-m-Y')
                                    ->placeholder('-'),
                                TextEntry::make('date_of_execution')
                                    ->label('Plandatum')
                                    ->date('d-m-Y')
                                    ->color(fn($state) => strtotime($state) < time() ? 'danger' : 'success')
                                    ->placeholder('-'),
                                TextEntry::make('startdate')
                                    ->label('Startdatum')
                                    ->date('d-m-Y')
                                    ->placeholder('-'),
                                TextEntry::make('enddate')
                                    ->label('Einddatum')
                                    ->date('d-m-Y')
                                    ->placeholder('-'),
                            ])->columns(2),

                        Tabs\Tab::make('Statistieken')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                TextEntry::make('quotes_count')
                                    ->label('Aantal offertes')
                                    ->badge()
                                    ->placeholder('0'),
                                TextEntry::make('reactions_count')
                                    ->label('Aantal reacties')
                                    ->badge()
                                    ->placeholder('0'),
                                TextEntry::make('timeTrackings_count')
                                    ->label('Uren geregistreerd')
                                    ->badge()
                                    ->placeholder('0'),
                            ])->columns(3),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ReactionsRelationManager::class,
            RelationManagers\TimeTrackingRelationManager::class,
            RelationManagers\QuotesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            "index" => Pages\ListProjects::route("/"),
            'view'  => Pages\ViewProjects::route('/{record}'),
        ];
    }
}
