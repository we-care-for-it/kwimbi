<?php
namespace App\Filament\Resources\RelationResource\RelationManagers;

use App\Models\Project;
use App\Models\Statuses;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\VerticalAlignment;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ProjectsRelationManager extends RelationManager
{
    protected static ?string $icon        = "heroicon-o-archive-box";
    protected static string $relationship = 'Projects';
    protected static ?string $title       = 'Projecten';

    public function form(Form $form): Form
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

                // Section::make()
                //     ->schema([
                //         Select::make("location_id")
                //             ->searchable()
                //             ->label("Locatie")
                //             ->columnSpan("full")
                //             ->options(ObjectLocation::where('customer_id', $this->getOwnerRecord()->id)->pluck("address", "id")),
                //     ])
                //     ->columns(2)
                //     ->columnSpan(1),

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

            ]);
    }

    public function table(Table $table): Table
    {
        return $table

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
                    ->searchable()
                    ->sortable()
                    ->verticalAlignment(VerticalAlignment::Start)
                    ->label("Adres")
                    ->getStateUsing(function (Project $record) {
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
                    ->placeholder('Onbekend')
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

            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Project Bewerken')
                    ->modalDescription('Pas de bestaande project aan door de onderstaande gegevens zo volledig mogelijk in te vullen.')
                    ->tooltip('Bewerken')
                    ->label('Bewerken')
                    ->modalIcon('heroicon-o-pencil')
                    ->slideOver(),

                Action::make('openRelation')
                    ->label('Open project')
                    ->url(function ($record) {
                        return "/projects/" . $record->id;
                    })->icon('heroicon-s-credit-card')
                ,

            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Project toevoegen')
                    ->modalHeading('Project toevoegen')
                    ->slideOver(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make(),
                ]),
            ])
            ->emptyState(view("partials.empty-state"));

    }
}
