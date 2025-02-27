<?php
namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Models\Contact;
use App\Models\ObjectLocation;
use App\Models\Project;
use App\Models\Relation;
use App\Models\Task;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class TaskResource extends Resource
{
    protected static ?string $model            = Task::class;
    protected static ?string $navigationIcon   = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel  = 'Taken';
    protected static ?string $pluralModelLabel = 'Taken';
    protected static ?string $title            = 'Taken';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->columnSpan('full'),

                Textarea::make('description')
                    ->rows(3)
                    ->label('Uitgebreide omschrijving')
                    ->helperText(str('Beschrijf de actie of taak ')->inlineMarkdown()->toHtmlString())
                    ->columnSpan('full')
                    ->autosize(),

                Select::make('model')
                    ->options([
                        'relation'      => 'Relatie',
                        //  'project'       => 'Project',
                        'contactperson' => 'Contactpersoon',
                        //  'object'        => 'Object',
                        'location'      => 'Locatie',
                    ])
                    ->searchable()
                    ->live()
                    ->label('Koppel aan'),

                Select::make('model_id')
                    ->options(Relation::where('type_id', 5)->where('company_id', Filament::getTenant()->id)->pluck('name', 'id'))
                    ->searchable()
                    ->visible(function (Get $get, Set $set) {
                        return $get('model') == 'relation' ?? false;
                    })
                    ->label('Relatie'),

                Select::make('model_id')
                    ->options(Project::pluck('name', 'id'))
                    ->searchable()
                    ->visible(function (Get $get, Set $set) {
                        return $get('model') == 'project' ?? false;
                    })
                    ->label('Project'),

                Select::make('model_id')
                    ->options(Contact::where('company_id', Filament::getTenant()->id)->pluck('first_name', 'id'))
                    ->searchable()
                    ->visible(function (Get $get, Set $set) {
                        return $get('model') == 'contactperson' ?? false;
                    })
                    ->label('Contactpersoon'),

                // Select::make('model_id')
                //     ->options(Elevator::pluck('nobo_no', 'id'))
                //     ->searchable()
                //     ->visible(function (Get $get, Set $set) {
                //         return $get('model') == 'object' ?? false;
                //     })
                //     ->label('Object'),

                Select::make('model_id')
                    ->options(ObjectLocation::where('company_id', Filament::getTenant()->id)->pluck('name', 'id'))
                    ->searchable()
                    ->visible(function (Get $get, Set $set) {
                        return $get('model') == 'location' ?? false;
                    })
                    ->label('Locatie'),

                Select::make('employee_id')
                    ->options(User::pluck('name', 'id'))
                    ->searchable()
                    ->default(Auth::id())
                    ->label('Medewerker'),

                Select::make('priority')
                    ->options([
                        '1' => 'Hoog',
                        '2' => 'Gemiddeld',
                        '3' => 'Laag',

                    ])
                    ->searchable()
                    ->label('Prioriteit'),

                DatePicker::make('begin_date')

                    ->label('Begindatum'),

                TimePicker::make('begin_time')
                    ->label('Tijd')
                    ->seconds(false),

                DatePicker::make('deadline')

                    ->label('Einddatum'),

                // ToggleButtons::make('private')
                //     ->label('Prive actie')
                //     ->default(1)
                //     ->boolean()
                //     ->grouped(),

                Select::make('type_id')
                    ->options([
                        '1' => 'Terugbelnotitie',
                        '3' => 'Te doen',

                    ])
                    ->searchable()
                    ->default(3)
                    ->label('Type'),

            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                Task::where('employee_id', Auth::id())
            )
            ->columns([

                Tables\Columns\TextColumn::make('id')
                // ->description(function ($record): ?string {
                //     if ($record?->private) {
                //         return "Priveactie";
                //     } else {
                //         return false;
                //     }
                // })
                    ->label('#')
                    ->sortable()
                    ->getStateUsing(function ($record): ?string {
                        return sprintf('%06d', $record?->id);
                    }),

                Tables\Columns\TextColumn::make('type_id')
                    ->badge()
                    ->sortable()
                    ->toggleable()
                    ->label('Type'),

                Tables\Columns\TextColumn::make('title')
                    ->description(function ($record): ?string {
                        if ($record?->description) {
                            return $record?->description;
                        } else {
                            return false;
                        }
                    })
                    ->label('Title')
                    ->sortable(),

                Tables\Columns\TextColumn::make('begin_date')
                    ->label('Plandatum')
                    ->placeholder('-')
                    ->toggleable()
                    ->sortable()
                    ->dateTime("d-m-Y")
                    ->sortable(),

                Tables\Columns\TextColumn::make('deadline')
                    ->label('Einddatum')
                    ->placeholder('-')
                    ->toggleable()
                    ->sortable()
                    ->dateTime("d-m-Y")
                    ->color(
                        fn($record) => strtotime($record?->deadline) <
                        time()
                        ? "danger"
                        : "success"
                    )
                    ->sortable(),

                Tables\Columns\TextColumn::make('related_to')
                    ->label('Gerelateerd  aan')
                    ->getStateUsing(function ($record): ?string {
                        switch ($record->model) {
                            case 'relation':
                                return $record?->related_to?->name;
                                break;
                            case 'project':
                                return $record?->related_to?->name;
                                break;
                            case 'location':
                                $housenumber   = "";
                                $complexnumber = "";
                                $name          = "";
                                if ($record->related_to?->housenumber) {
                                    $housenumber = " " . $record->related_to->housenumber;
                                }
                                return $record?->related_to->address . " " . $housenumber . " - " . $record->related_to?->zipcode . " - " . $record->related_to?->place;
                                break;
                            case 'object':
                                return $record->related_to->nobo_no;
                                break;
                            case 'contactperson':
                                return $record?->related_to?->first_name . " " . $record->related_to?->last_name;
                                break;
                            default:
                                return "-";
                        }
                    })->placeholder('-')

                    ->description(function ($record): ?string {
                        switch ($record->model) {
                            case 'relation':
                                return false;
                                break;
                            case 'project':
                                return false;
                                break;
                            case 'location':
                                return false;
                                break;
                            case 'object':
                                $housenumber   = "";
                                $complexnumber = "";
                                $name          = "";
                                if ($record?->related_to?->location->housenumber) {
                                    $housenumber = " " . $record->related_to->location->housenumber;
                                }
                                return $record?->related_to->location?->address . " " . $housenumber . " - " . $record->related_to?->location?->zipcode . " - " . $record->related_to?->location?->place;

                                break;
                            case 'contactperson':
                                return $record?->related_to?->email;

                                break;
                            default:
                                return false;
                        }
                    })

                ,

                Tables\Columns\TextColumn::make('employee.name')

                    ->label('Toegewezen aan'),

            ])
            ->filters([
                //
            ])
            ->actions([

                Tables\Actions\EditAction::make(),
                DeleteAction::make()

                    ->modalDescription(
                        "Weet je zeker dat je deze actie wilt voltooien ?"
                    )

                    ->modalIcon('heroicon-o-check')
                    ->modalHeading('Actie voltooien')
                    ->color('danger')
                    ->label('Voltooien'),

                RestoreAction::make()
                    ->color("danger")
                    ->modalHeading('Actie terug plaatsen')
                    ->modalDescription(
                        "Weet je zeker dat je deze actie wilt activeren"
                    ),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
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
