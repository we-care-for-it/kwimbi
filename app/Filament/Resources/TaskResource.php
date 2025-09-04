<?php

namespace App\Filament\Resources;

use App\Enums\Priority;
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
    protected static ?string $navigationLabel  = 'Alle taken';
    protected static ?string $pluralModelLabel = 'Alle taken';
    protected static ?string $title            = 'Alle taken';

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

                // Select::make('model')
                //     ->options([
                //         'relation' => 'Relatie',
                //         //  'project'       => 'Project',
                //         //   'contactperson' => 'Contactpersoon',
                //         //  'object'        => 'Object',

                //     ])
                //     ->searchable()
                //     ->live()
                //     ->label('Koppel aan'),
                // Select::make('model_id')
                //     ->label('Relatie')
                // //where('type_id', 5)->
                //     ->options(function () {
                //         return \App\Models\Relation::all()
                //             ->groupBy('type.name')
                //             ->mapWithKeys(function ($group, $category) {
                //                 return [
                //                     $category => $group->pluck('name', 'id')->toArray(),
                //                 ];
                //             })->toArray();
                //     }),

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

                Select::make('model_id')
                    ->options(Contact::where('company_id')->pluck('first_name', 'id'))
                    ->searchable()
                    ->visible(function (Get $get, Set $set) {
                        return $get('model') == 'contactperson' ?? false;
                    })
                    ->label('Contactpersoon'),
                Select::make('model_id')
                    ->options(ObjectLocation::pluck('name', 'id'))
                    ->visible(function (Get $get, Set $set) {
                        return $get('model') == 'location' ?? false;
                    })
                    ->label('Locatie'),

                Select::make('employee_id')
                    ->options(User::pluck('name', 'id'))
                    ->default(Auth::id())
->visible(fn () => auth()->user()->can('assign_to_employee_task'))
 


                    ->label('Interne medewerker'),
                Select::make('type_id')
                    ->options([
                        '1' => 'Terugbelnotitie',
                        '3' => 'Te doen',

                    ])
                    ->required()
                    ->searchable()
                    ->default(3)
                    ->label('Type'),

                ToggleButtons::make('priority')
                    ->options(Priority::class)

                    ->colors([
                        '1' => 'info',
                        '2' => 'warning',
                        '3' => 'success',

                    ])
                    ->default(3)->grouped()
                    ->label('Prioriteit'),

                CustomFieldsComponent::make()
                    ->columnSpanFull(),

                Section::make('Planning')
                    ->collapsed()
                    ->collapsed()
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

 

            ->persistSearchInSession()
            ->searchable()
            ->persistColumnSearchesInSession()
            ->recordClasses(
                fn($record) =>
                $record->deleted_at ? 'table_row_deleted ' : null
            )
            ->columns([

                TileColumn::make('employee')
                    // ->description(fn($record) => $record->AssignedByUser->email)
                    ->sortable()
                    ->getStateUsing(function ($record): ?string {
                        return $record?->employee?->name;
                    })
                    ->description(fn($record) => $record->employee?->email)
                    ->label('Toegewezen medewerker'),

                //     ->image(fn($record) => $record?->employee?->avatar)
                //     ->placeholder('Geen'),
                //Tables\Columns\TextColumn::make('id')
                // ->description(function ($record): ?string {
                //     if ($record?->private) {
                //         return "Priveactie";
                //     } else {
                //         return false;
                //     }
                // })
                // ->label('#')
                // ->sortable()
                // ->getStateUsing(function ($record): ?string {
                //     return sprintf('%06d', $record?->id);
                // }),

                Tables\Columns\TextColumn::make('type_id')
                    ->badge()
                    ->sortable()
                    ->toggleable()
                    ->label('Type'),

                Tables\Columns\TextColumn::make('related_to')
                    ->label('Relatie')
                    ->toggleable()
                    ->getStateUsing(function ($record): ?string {
                        return $record?->related_to?->name;
                    })->placeholder('-'),

                Tables\Columns\TextColumn::make('description')
                    ->label('Taak')
                    ->toggleable()
                    ->wrap()
                    ->placeholder('-'),

                // ->description(function ($record): ?string {
                //     return $record?->description;

                // }),

                Tables\Columns\TextColumn::make('priority')
                    ->badge()
                    ->sortable()
                    ->toggleable()
                    ->label('Prioriteit'),

                // Tables\Columns\TextColumn::make('description')
                //     ->wrap()

                //     ->label('Taak omschrijving')
                //     ->sortable()->description(function ($record): ?string {
                //     switch ($record->model) {
                //         case 'relation':
                //             return false;
                //             break;
                //         case 'project':
                //             return false;
                //             break;
                //         case 'location':
                //             return false;
                //             break;
                //         case 'object':
                //             $housenumber   = "";
                //             $complexnumber = "";
                //             $name          = "";
                //             if ($record?->related_to?->location->housenumber) {
                //                 $housenumber = " " . $record->related_to->location->housenumber;
                //             }
                //             return $record?->related_to->location?->address . " " . $housenumber . " - " . $record->related_to?->location?->zipcode . " - " . $record->related_to?->location?->place;

                //             break;
                //         case 'contactperson':
                //             return $record?->related_to?->email;

                //             break;
                //         default:
                //             return false;
                //     }
                // }),

                Tables\Columns\TextColumn::make('begin_date')
                    ->label('Plandatum')
                    ->placeholder('-')
                    ->sortable()
                    ->dateTime("d-m-Y")
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('deadline')
                    ->label('Einddatum')
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable()
                    ->dateTime("d-m-Y")
                    ->color(
                        fn($record) => strtotime($record?->deadline) <
                            time()
                            ? "danger"
                            : "success"
                    )
                    ->sortable(),

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
                        ->visible(fn () => auth()->user()->can('edit_any_task'))


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
    ->visible(fn ($record) =>
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
                        
                        ->label('Verwijderen')
                        
                   

,

                    RestoreAction::make()
                        ->color("danger")
                        ->modalHeading('Actie terug plaatsen')
                        ->modalDescription(
                            "Weet je zeker dat je deze actie wilt activeren"
                        ),

                    //      ActivityLogTimelineTableAction::make('Logboek'),

                ])           ->visible(fn ($record) =>
    auth()->user()->can('delete_any_task') // allowed globally
    || $record->employee_id === auth()->id() // allowed if owner
)

                
                
                
  ,

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
