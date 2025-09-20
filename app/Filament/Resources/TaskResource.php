<?php

namespace App\Filament\Resources;

use App\Enums\Priority;
use App\Enums\TaskTypes;
use App\Filament\Resources\TaskResource\Pages;
use App\Models\Contact;
use App\Models\Employee;
use App\Models\ObjectLocation;
use App\Models\Project;
use App\Models\relationLocation;
use App\Models\Task;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Relaticle\CustomFields\Filament\Forms\Components\CustomFieldsComponent;
use LaraZeus\Tiles\Tables\Columns\TileColumn;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Carbon;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Tables\Columns\TextColumn;
          use Filament\Tables\Columns\ImageColumn;
class TaskResource extends Resource implements HasShieldPermissions
{


    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
            'assign_to_employee',
            'edit_any',
            'compleet_any'
        ];
    }




    protected static ?string $model            = Task::class;
    protected static ?string $navigationIcon   = 'heroicon-o-list-bullet';
    protected static ?string $navigationLabel  = 'Mijn taken';
    protected static ?string $pluralModelLabel = 'Mijn taken';
    protected static ?string $title            = 'Mijn taken';

    protected $listeners = ["refresh" => '$refresh'];


    public static function getNavigationBadge(): ?string
    {
        return (string) Task::where('employee_id', auth()->id())->count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Textarea::make('description')
                    ->rows(3)
                    ->label('Uitgebreide omschrijving')
                    ->helperText(str('Beschrijf de actie of taak ')->inlineMarkdown()->toHtmlString())
                    ->columnSpan('full')
                    ->autosize(),
 
                Select::make("relation_id")
                    ->searchable()

                    ->label("Relatie")
                    ->options(function () {
                        return \App\Models\Relation::all()
                            ->groupBy('type.name')
                            ->mapWithKeys(function ($group, $category) {
                                return [
                                    $category => $group->pluck('name', 'id')->toArray(),
                                ];
                            })->toArray();
                    })

                    ->afterStateUpdated(function (callable $set) {
                        $set('location_id', null);
                        $set('contact_id', null);
                    })
                    ->reactive(),

                // Select::make("make_by_employee_id")
                //     ->label('Contactpersoon')
                //     ->options(function (callable $get) {
                //         $relationId = $get('relation_id');

                //         return Employee::query()
                //             ->when($relationId, fn($query) => $query->where('relation_id', $relationId))
                //             ->get()
                //             ->mapWithKeys(function ($location) {
                //                 return [
                //                     $location->id => collect([
                //                         $location->first_name,
                //                         $location->last_name,

                //                     ])->filter()->implode(', '),
                //                 ];
                //             })
                //             ->toArray();
                //     })
                //     ->reactive()
                //     ->disabled(fn(callable $get) => ! $get('relation_id'))

                //     ->placeholder('Selecteer een locatie'),

                Select::make("location_id")
                    ->label('Locatie')
                    ->options(function (callable $get) {
                        $relationId = $get('relation_id');

                        return relationLocation::query()
                            ->when($relationId, fn($query) => $query->where('relation_id', $relationId))
                            ->get()
                            ->mapWithKeys(function ($location) {
                                return [
                                    $location->id => collect([
                                        $location->address,
                                        $location->zipcode,
                                        $location->place,
                                    ])->filter()->implode(', '),
                                ];
                            })
                            ->toArray();
                    })
                    ->reactive()
                    ->disabled(fn(callable $get) => ! $get('relation_id'))
                    ->visible(Setting('tasks_in_location') ?? false)

                    ->placeholder('Selecteer een locatie'),

                Select::make('model_id')
                    ->options(Project::pluck('name', 'id'))
                    ->visible(function (Get $get, Set $set) {
                        return $get('model') == 'project' ?? false;
                    })
                    ->label('Project'),

                

                Select::make('employee_id')
                    ->options(User::pluck('name', 'id'))
                    ->default(Auth::id())
                    ->visible(fn() => auth()->user()->can('assign_to_employee_task'))



                    ->label('Interne medewerker'),
                Select::make('type')
                    ->options(TaskTypes::class)
                    ->default(TaskTypes::TODO) 
                    ->required()
                    ->searchable()
                    ->label('Type'),

                ToggleButtons::make('priority')
                    ->options(Priority::class)
                    ->default(Priority::LOW->value)
                    ->grouped()
                    ->label('Prioriteit'),

                CustomFieldsComponent::make()
                    ->columnSpanFull(),

                Section::make('Planning')
                  
                    ->columns(3)
                    ->schema([

                        DatePicker::make('begin_date')

                            ->label('Begindatum'),

                        TimePicker::make('begin_time')
                            ->label('Tijd')
                            ->seconds(false),

                        DatePicker::make('deadline')
                            ->label('Einddatum'),

                    ]),

                // ToggleButtons::make('private')
                //     ->label('Prive actie')
                //     ->default(1)
                //     ->boolean()
                //     ->grouped(),

                // Add the CustomFieldsComponent

            ]);
    }




    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();

        $query->where('employee_id', auth()->id());


        return $query;
    }
    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->persistSortInSession()
  ->description('Overzicht van alle taken die aan jou zijn toegewezen.')
          


            ->persistSearchInSession()
            ->searchable()
            ->persistColumnSearchesInSession()
            ->recordClasses(fn ($record) => 
            $record->deadline && strtotime($record->deadline) < now()->timestamp
                ? 'table_row_deleted'
                : null
            )
            ->columns([


                
ImageColumn::make('employee.avatar')
  ->size(30)
->tooltip(fn($record) => $record->employee->name)
->label('')
 
,


                  TextColumn::make('type')
                    ->badge()  // hard width limit
                    ->sortable()
                    ->toggleable()
                    ->width('100px')
                    ->label('Type'),
                                   
                TextColumn::make('priority')
                    ->badge()
                    ->sortable()  ->width('150px')
                    ->toggleable()
                    ->label('Prioriteit'),



          





                    //      TileColumn::make('')
                    //      ->label('Medewerker')
                    // ->description(fn($record) => $record->employee->email)
                    // ->sortable()
                    // ->searchable(['name', 'last_name'])
                    // ->image(fn($record) => $record->employee->avatar),
               


                TextColumn::make('related_to')
             
                    ->label('Relatie')
                    ->wrap(0)
                    ->toggleable()
                    ->getStateUsing(function ($record): ?string {
                        return $record?->related_to?->name;
                    })->placeholder('-'),


       
                TextColumn::make('description')
                    ->label('Taak')
                    ->grow()
                      ->description(fn ($record) =>
                        'Door: ' . ($record?->make_by_employee?->name ?? 'Onbekend') .
                        ' op ' . ($record?->created_at?->translatedFormat('d F Y') ?? '-') .
                        ' om ' . ($record?->created_at?->translatedFormat('H:i') ?? '-')
                    )
                    ->toggleable()
                    ->placeholder('-'),

                TextColumn::make('begin_date')
                    ->label('Plandatum')
                    ->placeholder('-')
                    ->sortable()
                    ->dateTime('d-m-Y')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deadline')
                    ->label('Einddatum')
                    ->placeholder('-')
                    ->dateTime('d-m-Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->color(fn ($record) => strtotime($record?->deadline) < now()->timestamp ? 'danger' : 'success'),
         

            ])
            ->filters([
                SelectFilter::make('relation_id')
                    ->label('Relatie')
                    ->searchable()
                    ->options(function () {
                        return \App\Models\Relation::all()
                            ->groupBy('type.name')
                            ->mapWithKeys(function ($group, $category) {
                                return [
                                    $category => $group->pluck('name', 'id')->toArray(),
                                ];
                            })->toArray();
                    }),
                // SelectFilter::make('employee_id')
                //     ->label('Medewerker')
                //         ->options(User::pluck('name', 'id'))
                //     ->default(Auth::id())
                //     ->searchable()
                //     ->visible(fn () => auth()->user()->can('assign_to_employee_task')),




                TrashedFilter::make(),

            ], layout: FiltersLayout::Modal)
            ->filtersFormColumns(3)
            ->actions([

                EditAction::make()
                    ->modalHeading('Taak Bewerken')
                    ->modalDescription('Pas de bestaande taak aan door de onderstaande gegevens zo volledig mogelijk in te vullen.')
                    ->tooltip('Bewerken')
                    ->slideOver()
                    ->visible(fn() => auth()->user()->can('edit_any_task'))


                    ->label('Bewerken'),


                Action::make('complete')
                    ->label('Voltooien')
                    ->icon('heroicon-o-check')
                    ->tooltip('Voltooien')
                    ->color('danger')
                    ->modalHeading('Actie voltooien')
                    ->modalDescription('Weet je zeker dat je deze actie wilt voltooien?')
                    ->modalIcon('heroicon-o-check')
                    ->requiresConfirmation()
                    ->visible(
                        fn($record) =>
                        auth()->user()->can('compleet_any_task') // allowed globally
                            || $record->employee_id === auth()->id() // allowed if owner
                    )



                    ->action(function ($record) {
                        $record->update([
                            'deleted_at' => Carbon::now(),
                        ]);
                    }),
                Tables\Actions\ActionGroup::make([

                    DeleteAction::make()
                        ->tooltip('Verwijderen')

                        ->label('Verwijderen'),

                    RestoreAction::make()
                        ->color("danger")
                        ->modalHeading('Actie terug plaatsen')
                        ->modalDescription(
                            "Weet je zeker dat je deze actie wilt activeren"
                        ),

                    //      ActivityLogTimelineTableAction::make('Logboek'),

                ])->visible(
                    fn($record) =>
                    auth()->user()->can('delete_any_task') // allowed globally
                        || $record->employee_id === auth()->id() // allowed if owner
                ),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([



                    ExportBulkAction::make()
                        ->exports([
                            ExcelExport::make()
                                ->fromTable()

                                ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                                ->withFilename(date("m-d-Y H:i") . " - Takenoverzicht export"),
                        ]),

                ]),

            ])->emptyState(view("partials.empty-state"));
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            // 'create' => Pages\CreateTask::route('/create'),
            //     'edit'   => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}

 