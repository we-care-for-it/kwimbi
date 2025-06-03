<?php
namespace App\Filament\Resources\RelationResource\RelationManagers;

use App\Enums\Priority;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Location;
use App\Models\ticketStatus;
use App\Models\ticketType;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use LaraZeus\Tiles\Tables\Columns\TileColumn;

class TicketRelationManager extends RelationManager
{
    protected static string $relationship = 'tickets';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {

        return $ownerRecord->tickets->count();
    }

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        if (! $ownerRecord->type) {
            return false;
        }

        $options = $ownerRecord->type->options ?? [];
        return in_array('Tickets', (array) $options);
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([

                        Forms\Components\Select::make('created_by_user')
                            ->searchable(['first_name', 'last_name', 'email'])

                            ->options(
                                Employee::where('relation_id', $this->ownerRecord->id)
                                    ->get()
                                    ->mapWithKeys(fn($employee) => [
                                        $employee->id => "{$employee->first_name} {$employee->last_name}",
                                    ])
                            )

                            ->createOptionForm([

                                Grid::make(4)
                                    ->schema([

                                        Forms\Components\TextInput::make('first_name')
                                            ->label('Voornaam')
                                            ->required()
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('last_name')
                                            ->label('Achternaam')
                                            ->required()
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('email')
                                            ->columnSpan(2)
                                            ->label('E-mailadres')
                                            ->email()
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('department')
                                            ->label('Afdeling')
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('function')
                                            ->label('Functie')
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('phone_number')
                                            ->label('Telefoonnummer')
                                            ->maxLength(255),

                                    ]),

                            ])

                            ->createOptionUsing(function (array $data): int {

                                $data['relation_id'] = $this->ownerRecord->id;
                                return Employee::create($data)->getKey();
                            })

                            ->label('Conmtactpersoon')

                            ->columnSpan(2)
                        ,

                        Forms\Components\Select::make('status_id')
                            ->default('1')
                            ->label('Status')
                            ->options(ticketStatus::pluck('name', 'id')),
                        Forms\Components\Select::make('type_id')
                            ->label('Type')
                            ->default('2')
                            ->options(ticketType::pluck('name', 'id')),

                        ToggleButtons::make('prio')
                            ->options(Priority::class)

                            ->colors([
                                '1' => 'info',
                                '2' => 'warning',
                                '3' => 'success',

                            ])
                            ->default(3)->grouped()
                            ->label('Prioriteit'),

                    ])->columns(3),

                Section::make()
                    ->schema([
                        Forms\Components\Select::make('department_id')
                            ->label('Afdeling toewijzing')

                            ->options(Department::pluck('name', 'id'))

                            ->createOptionForm([

                                Grid::make(2)
                                    ->schema([

                                        Forms\Components\TextInput::make('name')
                                            ->label('Afdelingsnaam')
                                            ->required(),

                                        Forms\Components\Select::make("location_id")
                                            ->label("Locatie")
                                            ->required()
                                            ->options(
                                                Location::pluck("name", "id")
                                            ),

                                    ]),

                            ])

                            ->createOptionUsing(function (array $data): int {

                                return Department::create($data)->getKey();
                            }),

                        Forms\Components\Select::make('assigned_by_user')
                            ->label('Medewerker')

                            ->options(User::pluck('name', 'id'))
                            ->searchable()
                            ->default(Auth::id())
                            ->label('Medewerker')

                            ->options(
                                User::get()
                                    ->mapWithKeys(fn($employee) => [
                                        $employee->id => "{$employee->name}",
                                    ])
                            ),
                    ])
                    ->columns(3),

                Section::make('Ticket omschrijving')
                    ->description('Zoals een foutmelding of aanvraag voor veranderingen')
                    ->schema([

                        Textarea::make('description')->label('Omschrijving')->columnSpan('full')
                            ->required()->rows(10),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->toggleable()
                    ->label('#')
                    ->getStateUsing(function ($record): ?string {
                        return sprintf("%05d", $record?->id);
                    }),

                //     ->label('Medewerker'),
                Tables\Columns\TextColumn::make('prio')
                    ->badge()
                    ->sortable()
                    ->toggleable()
                    ->label('Prioriteit'),
                Tables\Columns\TextColumn::make('status.name')
                    ->badge()
                    ->sortable()
                    ->toggleable()
                    ->label('Status'),

                Tables\Columns\TextColumn::make('created_at')
                    ->getStateUsing(function ($record): ?string {
                        return $record?->createByUser?->name;
                    })
                    ->toggleable()
                    ->label('Melder'),

                TileColumn::make('AssignedByUser')
                // ->description(fn($record) => $record->AssignedByUser->email)
                    ->sortable()
                    ->placeholder('Geen')
                    ->getStateUsing(function ($record): ?string {
                        return $record?->AssignedByUser?->name;
                    })
                    ->label('Medewerker')
                    ->toggleable()
                    ->searchable(['first_name', 'last_name'])
                    ->image(fn($record) => $record?->AssignedByUser?->avatar),

                Tables\Columns\TextColumn::make("address")
                    ->toggleable()
                    ->toggleable()
                    ->label('Locatie')
                    ->sortable()
                    ->getStateUsing(function ($record): ?string {

                        return $record?->location?->address . "-" . $record?->location?->zipcode . " - " . $record?->location?->place;
                    })
                    ->searchable()
                    //->label(fn() => "Adres (" . $this->getOwnerRecord()->locations()->count() . ")")
                    ->description(function ($record) {
                        return $record?->name;
                    }),

                Tables\Columns\TextColumn::make('department.name')
                    ->sortable()
                    ->toggleable()
                    ->badge()
                    ->placeholder('-')
                    ->placeholder('Geen')
                    ->label('Afdeling'),

                Tables\Columns\TextColumn::make('description')
                    ->sortable()
                    ->limit(50)
                    ->wrap()
                    ->toggleable()
                    ->lineClamp(2)
                    ->label('Omschrijving'),

                // Tables\Columns\TextColumn::make('AssignedByUser.name')
                //     ->sortable()
                //     ->toggleable()
                //     ->label('Medewerker'),

                Tables\Columns\TextColumn::make('type.name')
                    ->badge()
                    ->sortable()
                    ->toggleable()
                    ->label('Type')
                ,

            ])->recordUrl(
            fn($record): string => route('filament.app.resources.tickets.view', ['record' => $record])
        )
            ->filters([

            ], layout: FiltersLayout::AboveContent)
            ->filtersFormColumns(4)
            ->actions([

                Tables\Actions\ViewAction::make('OpenTicket')
                    ->label('Bekijk')
                    ->icon('heroicon-s-pencil')
                ,

                Tables\Actions\EditAction::make('editTicket')
                    ->label('Snel bewerken')
                    ->icon('heroicon-s-pencil')
                ,

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->tooltip('Bewerken')
                        ->slideOver()
                    ,

                    Tables\Actions\DeleteAction::make()
                        ->modalIcon('heroicon-o-trash')
                        ->tooltip('Verwijderen')
                        ->modalHeading('Verwijderen')
                        ->color('danger'),
                ]),
            ])
            ->headerActions([

                Tables\Actions\CreateAction::make()
                    ->modalWidth(MaxWidth::FourExtraLarge)
                    ->modalHeading('Ticket toevoegen')
                    ->slideOver()
                    ->modalDescription('Geef de onderstaande gegevens op om de ticket aan te maken.')
                //  ->icon('heroicon-m-plus')
                // ->modalIcon('heroicon-o-plus')
                    ->label('Ticket toevoegen')
                ,

            ])

            ->bulkActions([

            ])->emptyState(view("partials.empty-state"));
    }

}
