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
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

//Form

//tables


class ProjectsResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $title = 'Projecten';
    protected static ?string $SearchResultTitle = 'Projecten';
    protected static ?string $navigationGroup = 'Hoofdmenu';
    protected static ?string $navigationLabel = 'Projecten';
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static bool $isLazy = false;
    protected static ?string $recordTitleAttribute = 'name';


    // public static function getGlobalSearchResultDetails(Model $record): array
    // {
    //     return [
    //         'Author' => $record->name,
    //         'Category' => $record->name,
    //     ];
    // }
    protected $listeners = ['refresh' => '$refresh'];
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
                        Forms\Components\TextInput::make('name')
                            ->label('Naam')
                            ->maxLength(255)
                            ->required(),

                        TextInput::make('description')
                            ->label('Omschrijving'),


                    ])
                    ->columnSpan(['lg' => 1]),

                Section::make()
                    ->schema([


                        Grid::make([
                            'default' => 2,
                            'sm' => 2,
                            'md' => 2,
                            'lg' => 2,
                            'xl' => 2,
                            '2xl' => 2,
                        ])
                            ->schema([

                                DatePicker::make('requestdate')
                                    ->label('Aanvraag datum'),

                                DatePicker::make('startdate')
                                    ->label('Startdatum'),


                                DatePicker::make('startdate')
                                    ->label('Startdatum'),

                                DatePicker::make('enddate')
                                    ->label('Einddatum'),


                                DatePicker::make('date_of_execution')
                                    ->label('Plandatum'),


                            ]),


                    ])
                    ->columnSpan(['lg' => 1]),


                Section::make()
                    ->schema([


                        Grid::make([
                            'default' => 2,
                            'sm' => 2,
                            'md' => 2,
                            'lg' => 2,
                            'xl' => 2,
                            '2xl' => 2,
                        ])
                            ->schema([

                                TextInput::make('budget_costs')
                                    ->label('Budget')
                                    ->suffixIcon('heroicon-o-currency-euro'),


                                Select::make('status_id')
                                    ->label('Status')
                                    ->required()
                                    ->reactive()
                                    ->options(Statuses::where('model', 'Project')
                                        ->pluck('name', 'id')),


                            ]),


                        Grid::make([
                            'default' => 2,
                            'sm' => 2,
                            'md' => 2,
                            'lg' => 2,
                            'xl' => 2,
                            '2xl' => 2,
                        ])
                            ->schema([
                                TextInput::make('quote_price')
                                    ->label('Offertebedrag')
                                    ->suffixIcon('heroicon-o-currency-euro'),


                                TextInput::make('cost_price')
                                    ->label('Kostprijs')
                                    ->suffixIcon('heroicon-o-currency-euro')
                            ])


                    ])
                    ->columns(2)
                    ->columnSpan(['lg' => 1]),

                Section::make()
                    ->schema([


                        Select::make('customer_id')
                            ->searchable()
                            ->label('Relatie')
                            ->columnSpan('full')
                            ->options(Customer::all()
                                ->pluck('name', 'id')),

                        Select::make('location_id')
                            ->searchable()
                            ->label('Locatie')
                            ->columnSpan('full')
                            ->options(ObjectLocation::all()
                                ->pluck('address', 'id')),


                    ])
                    ->columns(2)
                    ->columnSpan(['lg' => 1]),

            ])
            ->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table->groups([

            Group::make('customer.name')
                ->label('Relatie'),
            Group::make('status_id')
                ->label('Status'),
        ])
            ->columns([


                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->getStateUsing(function (Project $record): ?string {
                        return sprintf('%08d', $record?->id);
                    })
                    ->searchable()->sortable(),


                Tables\Columns\TextColumn::make('name')
                    ->label('Naam')
                    ->searchable(),


                Tables\Columns\TextColumn::make('customer.name')
                    ->getStateUsing(function (Project $record): ?string {


                        return $record?->customer->name;

                    })
                    ->searchable()
                    ->sortable()
                    ->label('Adres')
                    ->description(function (Project $record) {

                        if (!$record?->location_id) {
                            return "Geen locatie gekoppeld";
                        } else {
                            return $record->location?->address . " - " . $record->location?->zipcode . "  " . $record->location?->place;
                        }


                    }
                    ),


                Tables\Columns\TextColumn::make('startdate')
                    ->label('Looptijd')
                    ->getStateUsing(function (Project $record): ?string {


                        $startdate = $record->startdate ? date("d-m-Y", strtotime($record?->startdate)) : "nodate";
                        $enddate = $record->enddate ? date("d-m-Y", strtotime($record?->enddate)) : "nodate";

                        if ($record->enddate || $record->$startdate) {
                            return $startdate . " - " . $enddate;
                        } else {
                            return "";
                        }

                    })
                    ->searchable(),


                Tables\Columns\TextColumn::make('description')
                    ->label('Omschrijving')
                    ->weight(FontWeight::Light)
                    ->sortable(),


                Tables\Columns\TextColumn::make('date_of_execution')
                    ->label('Plandatum')
                    ->getStateUsing(function (Project $record): ?string {


                        if ($record->date_of_execution) {
                            return date("d-m-Y", strtotime($record?->date_of_execution));
                        } else {
                            return "-";
                        }

                    })
                    ->searchable()
                    ->color(fn($record) => strtotime($record?->date_of_execution) < time() ? 'danger' : 'success')


                ,


                Tables\Columns\TextColumn::make('cost_price')
                    ->label('Winst')
                    ->getStateUsing(function (Project $record): ?string {
                        return $record?->quote_price - $record?->cost_price;
                    })->prefix('€')
                    ->color(fn($record) => $record?->quote_price - $record?->cost_price < 0 ? 'danger' : 'success')
                    ->badge()->sortable()
                    ->icon(fn($record) => $record?->quote_price - $record?->cost_price < 0 ? 'heroicon-m-exclamation-triangle' : false),


                Tables\Columns\TextColumn::make('budget_costs')
                    ->label('Over')
                    ->getStateUsing(function (Project $record): ?string {
                        $total_price = $record?->budget_costs - ($record?->quote_price - $record?->cost_price);
                        return $total_price;
                    })->prefix('€'),


                Tables\Columns\TextColumn::make('status.name')
                    ->label('Status')->sortable()
                    ->badge(),

            ])
            ->filters([

                SelectFilter::make('status_id')
                    ->label('Status')
                    ->options(Statuses::where('model', 'Project')
                        ->pluck('name', 'id'))
                    ->searchable()
                    ->preload(),

                SelectFilter::make('status_id')
                    ->label('Status')
                    ->options(Customer::get()
                        ->pluck('name', 'id'))
                    ->searchable()
                    ->preload()


            ])
            ->actions([

                Tables\Actions\ViewAction::make(),


                Tables\Actions\EditAction::make()
            ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([
                ExportBulkAction::make(),
            ]),])
            ->emptyState(view('partials.empty-state'));
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ReactionsRelationManager::class,
            RelationManagers\UploadsRelationManager::class,
            //RelationManagers\LocationsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [

            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProjects::route('/create'),
            //  'view' => Pages\ViewProjects::route('/{record}') ,
            'edit' => Pages\EditProjects::route('/{record}/edit')
        ];
    }


}

