<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ProjectsResource\Pages;
use App\Filament\Resources\ProjectsResource\RelationManagers;
use App\Models\Customer;
use App\Models\ObjectLocation;
use App\Models\Project;
use App\Models\Statuses;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\VerticalAlignment;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ProjectsResource extends Resource
{
    protected static ?string $model             = Project::class;
    protected static ?string $title             = "Projecten";
    protected static ?string $SearchResultTitle = "Projecten";

    protected static ?string $navigationLabel = "Projecten";
    protected static ?string $navigationIcon  = "heroicon-o-archive-box";
    protected static bool $isLazy             = false;

    protected static ?string $pluralModelLabel = 'Projecten';

    // public static function getGlobalSearchResultDetails(Model $record): array
    // {
    //     return [
    //         'Author' => $record->name,
    //         'Category' => $record->name,
    //     ];
    // }
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
                            DatePicker::make("requestdate")->label(
                                "Aanvraagdatum"
                            ),

                            DatePicker::make("date_of_execution")
                                ->label("Plandatum")
                                ->placeholder('Onbekend'),

                            DatePicker::make("startdate")->label("Startdatum"),
                            DatePicker::make("enddate")->label("Einddatum"),
                        ]),
                    ])
                    ->columnSpan(["lg" => 1]),

                Section::make()
                    ->schema([
                        Grid::make([
                            "default" => 2,
                            "sm"      => 2,
                            "md"      => 2,
                            "lg"      => 2,
                            "xl"      => 2,
                            "2xl"     => 2,
                        ])->schema(
                            components: [
                                TextInput::make("budget_costs")
                                    ->label("Budget")
                                    ->suffixIcon("heroicon-o-currency-euro")
                                    ->columnSpan("full"),

                                Select::make("status_id")
                                    ->label("Status")
                                    ->required()
                                    ->reactive()
                                    ->options(
                                        Statuses::where(
                                            "model",
                                            "Project"
                                        )->pluck("name", "id")
                                    )->columnSpan("full"),
                            ]
                        ),
                    ])->columnSpan(1),

                Section::make()
                    ->schema([
                        Select::make("customer_id")
                            ->searchable()
                            ->label("Relatie")
                            ->columnSpan("full")
                            ->options(Customer::all()->pluck("name", "id")),

                        Select::make("location_id")
                            ->searchable()
                            ->label("Locatie")
                            ->columnSpan("full")
                            ->options(
                                ObjectLocation::all()->pluck("address", "id")
                            ),
                    ])
                    ->columns(2)
                    ->columnSpan(1),
            ])
            ->columns(5);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                Group::make("customer.name")->label("Relatie")
                    ->titlePrefixedWithLabel(false),
                Group::make("status.name")->label("Status")
                    ->titlePrefixedWithLabel(false)
                    ->getKeyFromRecordUsing(fn(Project $record): string => $record->status->name),

            ])->defaultGroup("customer.name")
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
                    })->verticalAlignment(VerticalAlignment::Start),

                Tables\Columns\TextColumn::make("customer.name")
                    ->getStateUsing(function (Project $record): ?string {
                        return $record?->customer->name;
                    })
                    ->url(function (Project $record) {
                        return "/app/customers/" .
                        $record->customer_id .
                            "/edit";
                    })
                    ->searchable()
                    ->sortable()
                    ->verticalAlignment(VerticalAlignment::Start)
                    ->label("Adres")
                    ->description(function (Project $record) {
                        if (! $record?->location_id) {
                            return "Geen locatie gekoppeld";
                        } else {
                            return $record->location?->address .
                            " - " .
                            $record->location?->zipcode .
                            "  " .
                            $record->location?->place;
                        }
                    }),

                Tables\Columns\TextColumn::make("startdate")
                    ->label("Looptijd")
                    ->getStateUsing(function (Project $record): ?string {
                        $startdate = $record->startdate
                        ? date("d-m-Y", strtotime($record?->startdate))
                        : "nodate";
                        $enddate = $record->enddate
                        ? date("d-m-Y", strtotime($record?->enddate))
                        : "nodate";

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
                            return date(
                                "d-m-Y",
                                strtotime($record?->date_of_execution)
                            );
                        } else {
                            return false;
                        }
                    })
                    ->placeholder('Onbekend')
                    ->searchable()
                    ->color(
                        fn($record) => strtotime($record?->date_of_execution) <
                        time()
                        ? "danger"
                        : "success"
                    ),

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
                    ->options(
                        Statuses::where("model", "Project")->pluck("name", "id")
                    )
                    ->searchable()
                    ->preload(),

                SelectFilter::make("customer_id")
                    ->label("Relatie")
                    ->options(Customer::get()->pluck("name", "id"))
                    ->searchable()
                    ->preload(),

            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Open details'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make(),
                ]),
            ])
            ->emptyState(view("partials.empty-state"));
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ReactionsRelationManager::class,
            //RelationManagers\UploadsRelationManager::class,
            RelationManagers\QuotesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            "index"  => Pages\ListProjects::route("/"),
            "create" => Pages\CreateProjects::route("/create"),
            //  'view' => Pages\ViewProjects::route('/{record}') ,
            "edit"   => Pages\EditProjects::route("/{record}/edit"),
        ];
    }
}
