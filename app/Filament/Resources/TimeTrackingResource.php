<?php
namespace App\Filament\Resources;

use App\Enums\TimeTrackingStatus;
use App\Filament\Resources\TimeTrackingResource\Pages;
use App\Models\Project;
use App\Models\Relation;
use App\Models\timeTracking;
use App\Models\User;
use App\Models\workorderActivities;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class TimeTrackingResource extends Resource
{
    protected static ?string $model = timeTracking::class;

    protected static ?string $navigationIcon   = 'heroicon-o-clock';
    protected static ?string $navigationLabel  = "Tijdregistratie";
    protected static ?string $title            = "Tijdregistratie";
    protected static ?string $pluralModelLabel = 'Tijdregistratie';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\DatePicker::make('started_at')
                                    ->label('Datum')
                                    ->closeOnDateSelection()
                                    ->default(now())
                                    ->required(),
                                Forms\Components\TimePicker::make('time')
                                    ->label('Tijd')
                                    ->seconds(false)
                                    ->required(),
                                Forms\Components\Select::make("relation_id")
                                    ->label("Relatie")
                                    ->searchable()
                                    ->options(Relation::where('type_id', 5)->pluck("name", "id"))
                                    ->placeholder("Niet opgegeven"),
                                Forms\Components\Select::make("project_id")
                                    ->label("Project")
                                    ->searchable()
                                    ->placeholder("Niet opgegeven")
                                    ->options(Project::pluck("name", "id")),
                                Forms\Components\Select::make('status_id')
                                    ->label('Status')
                                    ->options(TimeTrackingStatus::class)
                                    ->default(2)
                                    ->required(),
                                Forms\Components\Select::make('work_type_id')
                                    ->label('Type')
                                    ->searchable()
                                    ->options(workorderActivities::where('is_active', 1)->pluck("name", "id"))
                                    ->required(),
                                TextArea::make('description')
                                    ->label('Omschrijving')
                                    ->required()
                                    ->columnSpan('full'),
                                Forms\Components\Toggle::make('invoiceable')
                                    ->label('Facturabel')
                                    ->default(true),
                            ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                Group::make('weekno')
                    ->label('Weeknummer'),
                Group::make('project_id')
                    ->label('Project'),
                Group::make('relation_id')
                    ->getTitleFromRecordUsing(fn(TimeTracking $record): string => ucfirst($record?->relation?->name))
                    ->label('Relatie'),
                Group::make('status_id')
                    ->label('Status'),
                Group::make('invoiceable')
                    ->label('Facturable'),
            ])
            ->columns([
                TextColumn::make('started_at')
                    ->label('Datum')
                    ->sortable()
                    ->toggleable()
                    ->width(50)
                    ->date('d-m-Y')
                    ->placeholder('-')
                    ->searchable(),
                TextColumn::make('time')
                    ->label('Uren')
                    ->sortable()
                    ->toggleable()
                    ->placeholder('-')
                    ->width(10),
                TextColumn::make('weekno')
                    ->label('Week nr.')
                    ->width(50)
                    ->placeholder('-')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Activiteit')
                    ->wrap()
                    ->placeholder('-')
                    ->searchable(),
                TextColumn::make('relation.name')
                    ->label('Relatie')
                    ->toggleable()
                    ->sortable()
                    ->placeholder('-')
                    ->searchable(),
                TextColumn::make('project.name')
                    ->sortable()
                    ->label('Project')
                    ->toggleable()
                    ->sortable()
                    ->placeholder('-')
                    ->searchable(),
                TextColumn::make('status_id')
                    ->sortable()
                    ->label('Status')
                    ->badge()
                    ->toggleable()
                    ->sortable()
                    ->placeholder('-')
                    ->searchable(),
                ToggleColumn::make('invoiceable')
                    ->label('Facturabel')
                    ->onColor('success')
                    ->sortable()
                    ->toggleable()
                    ->offColor('danger')
                    ->width(100),
            ])
            ->filters([
                SelectFilter::make('periode_id')
                    ->label('Periode')
                    ->options([
                        '1' => 'Deze week',
                        '2' => 'Deze maand',
                        '3' => 'Dit kwartaal',
                        '4' => 'Dit jaar',
                        '5' => 'Gisteren',
                        '6' => 'Vorige week',
                        '7' => 'Vorige maand',
                        '8' => 'Vorig kwartaal',
                        '9' => 'Vorig jaar',
                    ]),
                SelectFilter::make('user_id')
                    ->options(User::all()->pluck("name", "id"))
                    ->label('Medewerker'),
                SelectFilter::make('relation_id')
                    ->label('Relatie')
                    ->options(Relation::where('type_id', 5)->pluck("name", "id")),
                SelectFilter::make('project_id')
                    ->options(Project::all()->pluck("name", "id"))
                    ->label('Project'),
                SelectFilter::make('status_id')
                    ->options(TimeTrackingStatus::class)
                    ->label('Status'),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Tijdregistratie Bewerken')
                    ->modalDescription('Pas de bestaande tijdregistratie aan door de onderstaande gegevens zo volledig mogelijk in te vullen.')
                    ->tooltip('Bewerken')
                    ->label('')
                    ->modalIcon('heroicon-o-pencil')
                    ->slideOver(),
                Tables\Actions\DeleteAction::make()
                    ->modalIcon('heroicon-o-trash')
                    ->tooltip('Verwijderen')
                    ->label('')
                    ->modalHeading('Verwijderen')
                    ->color('danger'),
            ])
            ->bulkActions([
                ExportBulkAction::make()
                    ->exports([
                        ExcelExport::make()
                            ->fromTable()
                            ->askForFilename()
                            ->withColumns([
                                Column::make("started_at")->heading("Datum"),
                                Column::make("weekno")->heading("Weeknummer"),
                                Column::make("time")->heading("Tijd"),
                                Column::make("description")->heading("Omschrijving"),
                                Column::make("relation.name")->heading("Relatie"),
                                Column::make("project.name")->heading("Project"),
                                Column::make("status_id")->heading("Status"),
                                Column::make("invoiceable")->heading("Facturable"),
                            ])
                            ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                            ->withFilename(date("m-d-Y H:i") . " - Tijdregistratie export")
                    ])
            ])
            ->emptyState(view("partials.empty-state"));
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Tabs::make('Tijdregistratie Details')
                    ->columnSpan('full')
                    ->tabs([
                        Tabs\Tab::make('Basisinformatie')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextEntry::make('started_at')
                                    ->label('Datum')
                                    ->date('d-m-Y')
                                    ->placeholder('-'),
                                TextEntry::make('time')
                                    ->label('Tijd')
                                    ->placeholder('-'),
                                TextEntry::make('description')
                                    ->label('Omschrijving')
                                    ->placeholder('-'),
                            ])->columns(3),
                            
                        Tabs\Tab::make('Relatie & Project')
                            ->icon('heroicon-o-link')
                            ->schema([
                                TextEntry::make('relation.name')
                                    ->label('Relatie')
                                    ->placeholder('-'),
                                TextEntry::make('project.name')
                                    ->label('Project')
                                    ->placeholder('-'),
                                TextEntry::make('workType.name')
                                    ->label('Type werk')
                                    ->placeholder('-'),
                            ])->columns(3),
                            
                        Tabs\Tab::make('Status & Facturatie')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                TextEntry::make('status_id')
                                    ->label('Status')
                                    ->badge()
                                    ->placeholder('-'),
                                TextEntry::make('invoiceable')
                                    ->label('Facturabel')
                                    ->formatStateUsing(fn ($state) => $state ? 'Ja' : 'Nee')
                                    ->placeholder('-'),
                                TextEntry::make('user.name')
                                    ->label('Medewerker')
                                    ->placeholder('-'),
                            ])->columns(3),
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTimeTrackings::route('/'),
            'view'  => Pages\ViewTimeTracking::route('/{record}'),
        ];
    }
}