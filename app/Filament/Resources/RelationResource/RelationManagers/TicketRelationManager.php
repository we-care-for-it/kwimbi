<?php
namespace App\Filament\Resources\RelationResource\RelationManagers;

use App\Enums\Priority;
use App\Enums\TicketStatus;
use App\Enums\TicketTypes;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use LaraZeus\Tiles\Forms\Components\TileSelect;
use LaraZeus\Tiles\Tables\Columns\TileColumn;

class TicketRelationManager extends RelationManager
{
    protected static string $relationship = 'tickets';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        // $ownerModel is of actual type Job
        return $ownerRecord->notes->count();
    }

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {

        return in_array('Tickets', $ownerRecord?->type?->options) ? true : false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Ticket gegevens')
                    ->schema([

                        TileSelect::make('created_by_user')
                            ->searchable(['first_name', 'last_name', 'email'])
                            ->options(Employee::where('relation_id', $this->ownerRecord->id)->pluck("first_name", "id"))
                            ->titleKey('created_by_user')
                            ->imageKey('avatar')
                            ->descriptionKey('email')
                            ->label('Melder'),

                        Forms\Components\Select::make('status_id')
                            ->default('1')
                            ->label('Status')
                            ->options(TicketStatus::Class),
                        Forms\Components\Select::make('type_id')
                            ->label('Type')
                            ->default('2')
                            ->options(TicketTypes::Class),
                        Forms\Components\Select::make('department_id')
                            ->label('Afdeling')
                            ->options(Department::pluck('name', 'id')),

                        Forms\Components\Select::make('prio')
                            ->label('Prioriteit')
                            ->options(Priority::class)
                            ->default('3'),

                        Forms\Components\Select::make('assigned_by_user')
                            ->label('Medewerker')
                            ->options(User::all()->pluck("name", "id")),

                    ])->columns(3),

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
                Tables\Columns\TextColumn::make('status_id')
                    ->badge()
                    ->sortable()
                    ->toggleable()
                    ->label('Status'),

                Tables\Columns\TextColumn::make('created_at')
                    ->getStateUsing(function ($record): ?string {
                        return $record?->createByUser?->name;
                    })

                    ->description(function ($record): ?string {
                        return date("d-m-Y H m:s", strtotime($record?->created_at));
                    })
                    ->label('Melder'),

                TileColumn::make('AssignedByUser')
                // ->description(fn($record) => $record->AssignedByUser->email)
                    ->sortable()
                    ->placeholder('Geen')
                    ->getStateUsing(function ($record): ?string {
                        return $record?->AssignedByUser?->name;
                    })
                    ->label('Medewerker')
                    ->searchable(['first_name', 'last_name'])
                    ->image(fn($record) => $record?->AssignedByUser?->avatar),

                Tables\Columns\TextColumn::make('department.name')
                    ->sortable()
                    ->toggleable()
                    ->badge()
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

                Tables\Columns\TextColumn::make('type_id')
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
                Tables\Actions\EditAction::make()->slideOver(),
                Tables\Actions\ViewAction::make('openLocation')
                    ->label('Bekijk')
                    ->url(fn($record): string => route('filament.app.resources.tickets.view', ['record' => $record]))

                    ->icon('heroicon-s-eye'),

            ])
            ->headerActions([

                Tables\Actions\CreateAction::make()
                    ->modalWidth(MaxWidth::FourExtraLarge)
                    ->modalHeading('Ticket toevoegen')
                    ->modalDescription('Geef de onderstaande gegevens op om de ticket aan te maken.')
                    ->icon('heroicon-m-plus')
                    ->modalIcon('heroicon-o-plus')
                    ->label('Ticket toevoegen')
                    ->slideOver(),

            ])

            ->bulkActions([

            ])->emptyState(view("partials.empty-state"));
    }
}
