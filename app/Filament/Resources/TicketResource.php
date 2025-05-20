<?php
namespace App\Filament\Resources;

use App\Enums\Priority;
use App\Enums\TicketStatus;
use App\Enums\TicketTypes;
use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Models\Department;
use App\Models\Relation;
use App\Models\Ticket;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use LaraZeus\Tiles\Tables\Columns\TileColumn;

class TicketResource extends Resource
{

    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon   = 'heroicon-o-queue-list';
    protected static ?string $navigationLabel  = 'Tickets';
    protected static ?string $pluralModelLabel = 'Tickets';
    protected static ?string $title            = 'Tickets';

    public static function shouldRegisterNavigation(): bool
    {
        return setting('use_tickets') ?? false;
    }

    public static function form(Form $form): Form
    {

        return $form
            ->schema([

                Section::make('Ticket gegevens')
                    ->schema([
                        Forms\Components\Select::make("relation_id")
                            ->label("Relatie")
                            ->searchable()
                            ->columnSpan('2')
                            ->options(function () {
                                return \App\Models\Relation::all()
                                    ->groupBy('type.name')
                                    ->mapWithKeys(function ($group, $category) {
                                        return [
                                            $category => $group->pluck('name', 'id')->toArray(),
                                        ];
                                    })->toArray();
                            })
                            ->searchable()
                            ->live()

                        // ->createOptionUsing(function (array $data) {
                        //     return Relation::create([
                        //         'name'    => $data['name'],
                        //         'type_id' => 5,
                        //     ])->id;
                        // })
                            ->options(function () {
                                return \App\Models\Relation::all()
                                    ->groupBy('type.name')
                                    ->mapWithKeys(function ($group, $category) {
                                        return [
                                            $category => $group->pluck('name', 'id')->toArray(),
                                        ];
                                    })->toArray();
                            })

                            ->placeholder("Niet opgegeven"),
                        Forms\Components\Select::make('assigned_by_user')
                            ->label('Medewerker')
                            ->options(User::all()->pluck("name", "id")),

                        Forms\Components\Select::make('status_id')
                            ->default('1')
                            ->label('Status')
                            ->options(TicketStatus::Class),
                        Forms\Components\Select::make('type_id')
                            ->label('Uursoort')
                            ->default('2')
                            ->options(TicketTypes::Class),
                        Forms\Components\Select::make('department_id')
                            ->label('Afdeling')
                            ->options(Department::pluck('name', 'id')),

                        Forms\Components\Select::make('prio')
                            ->label('Prioriteit')
                            ->options(Priority::class)
                            ->default('3'),
                    ])->columns(3),

                Section::make('Ticket omschrijving')
                    ->description('Zoals een foutmelding of aanvraag voor veranderingen')
                    ->schema([

                        Textarea::make('description')->label('Omschrijving')->columnSpan('full')
                            ->required()->rows(10),
                    ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            \Filament\Infolists\Components\Section::make()

                ->schema([

                    Components\TextEntry::make('relation.name')
                        ->label("Relatie")
                        ->placeholder("Niet opgegeven"),

                    Components\TextEntry::make('type_id')
                        ->label("Type")
                        ->badge()
                        ->placeholder("Niet opgegeven"),

                    Components\TextEntry::make('status_id')
                        ->label("Status")
                        ->badge()
                        ->placeholder("Niet opgegeven"),
                    Components\TextEntry::make('AssignedByUser.name')
                        ->label("Medewerker")
                        ->badge()
                        ->placeholder("Niet toegewezen"),

                    // TileEntry::make('AssignedByUser.name')
                    //     ->columnSpanFull()
                    //     ->label('Toegvoegd door')
                    //     ->description(fn($record) => $record->AssignedByUser->email)
                    //     ->image(fn($record) => $record?->AssignedByUser?->avatar),

                    // TileEntry::make('AssignedByUser.name')
                    //     ->columnSpanFull()
                    //     ->label('Gemaakt door')
                    //     ->description(fn($record) => $record->createByUser->email)
                    //     ->image(fn($record) => $record?->createByUser?->avatar),

                    Components\TextEntry::make('createByUser.name')
                        ->label("Aangemaak door")
                        ->badge()
                        ->placeholder("Niet toegewezen"),

                    Components\TextEntry::make('created_at')
                        ->label("Aangemaakt op")
                        ->Date('d-m-Y H:i')
                        ->placeholder("Niet toegewezen"),

                    Components\TextEntry::make('prio')
                        ->label("Prioriteit")
                        ->badge()
                        ->placeholder("Niet opgegeven"),

                    Components\TextEntry::make('department.name')
                        ->label("Afdeling")

                        ->placeholder("Niet opgegeven"),

                ])->columns(4),

            \Filament\Infolists\Components\Section::make('Ticket omschrijving')
                ->schema([
                    // ...

                    Components\TextEntry::make('description')
                        ->hiddenLabel()
                        ->placeholder("Geen opmerking"),
                ]),
        ]);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['id', 'relation.name', 'description'];
    }

    public static function getGlobalSearchResultDetails($record): array
    {

        return [
            'Nummer'  => sprintf("%05d", $record?->id),
            'Relatie' => $record?->relation?->name ?? "Onbekend",
        ];

    }

    public static function table(Table $table): Table
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

                //     ->label('Medewerker'),
                Tables\Columns\TextColumn::make('status_id')
                    ->badge()
                    ->sortable()

                    ->toggleable()
                    ->label('Status'),
                TileColumn::make('AssignedByUser')
                // ->description(fn($record) => $record->AssignedByUser->email)
                    ->sortable()
                    ->getStateUsing(function ($record): ?string {
                        return $record?->AssignedByUser?->name;
                    })
                    ->label('Toegewezen medewerker')
                    ->searchable(['first_name', 'last_name'])
                    ->image(fn($record) => $record?->AssignedByUser?->avatar)
                    ->placeholder('Geen'),

                Tables\Columns\TextColumn::make('created_at')
                    ->getStateUsing(function ($record): ?string {
                        return $record?->createByUser?->name;
                    })

                    ->description(function ($record): ?string {
                        return date("d-m-Y H m:s", strtotime($record?->created_at));
                    })
                    ->label('Gemeld'),
                Tables\Columns\TextColumn::make('relation.name')
                    ->sortable()
                    ->toggleable()
                    ->label('Relatie'),

                Tables\Columns\TextColumn::make('department.name')
                    ->sortable()
                    ->toggleable()
                    ->badge()

                    ->label('Afdeling'),

                Tables\Columns\TextColumn::make('description')
                    ->sortable()
                    ->limit(50)
                    ->toggleable()
                    ->wrap()
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
                    ->label('Uursoort'),

            ])
            ->filters([
                SelectFilter::make('relation_id')
                    ->label('Relatie')

                    ->options(Relation::all()->pluck("name", "id")),
                SelectFilter::make('assigned_by_user')
                    ->label('Medewerker')
                    ->options(User::all()->pluck("name", "id")),

                SelectFilter::make('status_id')
                    ->label('Status')
                    ->options(TicketStatus::Class),

            ], layout: FiltersLayout::AboveContent)
            ->filtersFormColumns(4)
            ->actions([
                Tables\Actions\EditAction::make()->slideOver(),
                Tables\Actions\ViewAction::make('openLocation')
                    ->label('Bekijk')
                    ->url(fn($record): string => route('filament.app.resources.tickets.view', ['record' => $record]))
                    ->icon('heroicon-s-eye'),
            ])->recordUrl(
            fn($record): string => route('filament.app.resources.tickets.view', ['record' => $record])
        )
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])->emptyState(view("partials.empty-state"));
    }

    public static function getRelations(): array
    {
        return [

            RelationManagers\TimeTrackingRelationManager::class,
        ];
    }
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            //    'edit'   => Pages\EditTicket::route('/{record}/edit'),
            'view'   => Pages\ViewTicket::route('/{record}'),
        ];
    }

}
