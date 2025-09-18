<?php

namespace App\Filament\Resources\RelationResource\RelationManagers;

use App\Enums\Priority;
use App\Enums\TaskTypes;
use App\Models\{Contact, Employee, ObjectLocation, Project, RelationLocation, Task, User};
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\{DatePicker, Section, Select, Textarea, TimePicker, ToggleButtons};
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\{Action, ActionGroup, CreateAction, DeleteAction, DeleteBulkAction, EditAction};
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use LaraZeus\Tiles\Tables\Columns\TileColumn;
use Relaticle\CustomFields\Filament\Forms\Components\CustomFieldsComponent;
   use Filament\Tables\Columns\ImageColumn;
 use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
 use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Support\Carbon;
use Filament\Tables\Enums\FiltersLayout;
class TasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';
    protected static ?string $icon = 'heroicon-o-rectangle-stack';
    protected static ?string $title = 'Taken';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return $ownerRecord->tasks()->count();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Textarea::make('description')
                ->rows(3)
                ->label('Uitgebreide omschrijving')
                ->helperText(str('Beschrijf de actie of taak ')->inlineMarkdown()->toHtmlString())
                ->columnSpanFull()
                ->autosize(),

            Select::make('location_id')
                ->label('Locatie')
                ->options(fn () => RelationLocation::query()
                    ->where('relation_id', $this->getOwnerRecord()->id)
                    ->get()
                    ->mapWithKeys(fn ($location) => [
                        $location->id => collect([
                            $location->address,
                            $location->zipcode,
                            $location->place,
                        ])->filter()->implode(', '),
                    ])
                    ->toArray()
                )
                ->reactive()
                ->visible(fn () => setting('tasks_in_location') ?? false)
                ->placeholder('Selecteer een locatie'),

            Select::make('model_id')
                ->options(Project::pluck('name', 'id'))
                ->visible(fn (Get $get) => $get('model') === 'project')
                ->label('Project'),

            Select::make('model_id')
                ->options(Contact::pluck('first_name', 'id'))
                ->searchable()
                ->visible(fn (Get $get) => $get('model') === 'contactperson')
                ->label('Contactpersoon'),

            Select::make('model_id')
                ->options(ObjectLocation::pluck('name', 'id'))
                ->visible(fn (Get $get) => $get('model') === 'location')
                ->label('Locatie'),

            Select::make('employee_id')
                ->options(User::pluck('name', 'id'))
                ->default(Auth::id())
                ->visible(fn () => auth()->user()->can('assign_to_employee_task'))
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

            CustomFieldsComponent::make()->columnSpanFull(),

            Section::make('Planning')
                ->columns(3)
                ->schema([
                    DatePicker::make('begin_date')->label('Begindatum'),
                    TimePicker::make('begin_time')->label('Tijd')->seconds(false),
                    DatePicker::make('deadline')->label('Einddatum'),
                ]),
        ]);
    }

    public function table(Table $table): Table
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


                
ImageColumn::make('employee.avatar')
  ->size(30)
->tooltip(fn($record) => $record?->employee?->name)
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
               

 
       
                TextColumn::make('description')
                    ->label('Taak')
                    ->grow()
                   
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
            ->headerActions([
                CreateAction::make()
                    ->modalWidth(MaxWidth::FourExtraLarge)
                    ->modalHeading('Taak toevoegen')
                    ->modalDescription('Voeg een nieuwe taak toe door de onderstaande gegevens zo volledig mogelijk in te vullen.')
                    ->icon('heroicon-m-plus')
                    ->modalIcon('heroicon-o-plus')
                    ->label('Taak toevoegen')
                    ->link()
                    ->mutateFormDataUsing(fn (array $data): array => [
                        ...$data,
                        'model_id' => $this->getOwnerRecord()->id,
                        'model'    => 'relation',
                    ]),
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
                    DeleteBulkAction::make()->label('Geselecteerde verwijderen'),
                ]),
            ]);
    }
}
