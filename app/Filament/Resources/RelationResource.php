<?php
namespace App\Filament\Resources;

use App\Filament\Resources\RelationResource\Pages;
use App\Filament\Resources\RelationResource\RelationManagers;
use App\Models\Relation;
use App\Models\relationType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;

//Form

class RelationResource extends Resource
{
    protected static ?string $model = Relation::class;

    protected static ?string $navigationIcon       = 'heroicon-s-building-library';
    protected static ?string $navigationLabel      = "Relaties";
    protected static ?string $pluralModelLabel     = 'Relaties';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make()->schema([

                Forms\Components\TextInput::make("name")
                    ->label("Naam / Bedrijfsnaam")
                    ->required()

                    ->columnSpan("full"),

                // Grid::make(5)->schema([Forms\Components\TextInput::make("zipcode")
                //         ->label("Postcode")
                //         ->maxLength(255)
                //         ->suffixAction(Action::make("searchAddressByZipcode")
                //                 ->icon("heroicon-m-magnifying-glass")
                //                 ->action(function (Get $get, Set $set) {

                //                     $data = (new AddressService())->GetAddress($get("zipcode"), $get("number"));
                //                     $data = json_decode($data);

                //                     if (isset($data->error_id)) {
                //                         Notification::make()
                //                             ->warning()
                //                             ->title("Geen resultaten")
                //                             ->body("Helaas er zijn geen gegevens gevonden bij de postcode <b>" . $get("zipcode") . "</b> Controleer de postcode en probeer opnieuw.")->send();
                //                     } else {
                //                         $set("place", $data?->municipality);
                //                         $set("address", $data?->street);
                //                         $set("place", $data?->settlement);
                //                     }
                //                 })),

                //     Forms\Components\TextInput::make("address")
                //         ->label("Adres")
                //         ->columnSpan(2),
                //     Forms\Components\TextInput::make("place")
                //         ->label("Plaats")
                //         ->columnSpan(2),

                Forms\Components\Select::make('type_id')
                    ->required()
                    ->label("Categorie")
                    ->options(RelationType::where('is_active', 1)->pluck('name', 'id')),

                //])
                // ->columns(3)
                // ->columnSpan(4),
            ]),
            Forms\Components\Section::make()->schema([

                Forms\Components\Textarea::make("remark")
                    ->label("Opmerking")
                    ->columnSpan("full"),
            ]),

        ]);

    }

    public static function infolist(Infolist $infolist): Infolist
    {

        return $infolist->schema([
            Tabs::make('Contact Informatie') // Hoofd-tab component
                ->columnSpan('full')
                ->tabs([
                    Tabs\Tab::make('Algemene Informatie')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            Components\TextEntry::make('name')
                                ->label("Bedrijfsnaam")
                                ->placeholder("Niet opgegeven"),

                            Components\TextEntry::make('type.name')
                                ->label("Categorie")
                                ->badge()
                                ->placeholder("Niet opgegeven"),

                            Components\TextEntry::make("parentaddress.name")
                                ->label("Adres")
                                ->getStateUsing(function ($record): ?string {
                                    $housenumber = "";

                                    if ($record?->parentaddress?->housenumber) {
                                        $housenumber = " " . $record?->parentaddress?->housenumber;
                                    }

                                    return $record?->parentaddress?->address . " " . $housenumber . " - " . $record?->parentaddress?->zipcode . " - " . $record?->parentaddress?->place;

                                })
                                ->placeholder("Niet opgegeven")->columns(4)])->columns(4),
                ]),

            Section::make()
                ->schema([
                    // ...

                    Components\TextEntry::make('remark')
                        ->label("Opmerking")
                        ->placeholder("Geen opmerking"),
                ]),
        ]);

    }

    public static function table(Table $table): Table
    {
        return

        $table->groups([Group::make("type.name")
                ->titlePrefixedWithLabel(false)
                ->label("Categorie"),

        ])
            ->defaultGroup('type.name')->

            columns([

            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->weight('medium')
                ->alignLeft()
                ->placeholder('-')
                ->label('Bedrijfsnaam'),

            Tables\Columns\TextColumn::make("parentaddress")
                ->toggleable()
                ->getStateUsing(function ($record): ?string {
                    $housenumber = "";

                    if ($record?->parentaddress?->housenumber) {
                        $housenumber = " " . $record?->parentaddress?->housenumber;
                    }

                    return $record?->parentaddress?->address . " " . $housenumber;

                })
                ->searchable()
                ->label("Adres")->description(function ($record) {

            }),

            Tables\Columns\TextColumn::make('zipcode')
                ->placeholder('-')
                ->label('Postcode')
                ->state(function (Relation $rec) {
                    return $rec->parentaddress?->zipcode;
                }),

            Tables\Columns\TextColumn::make('place')
                ->placeholder('-')
                ->label('Plaats')
                ->state(function (Relation $rec) {
                    return $rec->parentaddress?->place;
                }),

            Tables\Columns\TextColumn::make('type.name')
                ->label('Categorie')
                ->columnSpan("full")
                ->badge()
                ->placeholder('-')
                ->searchable()
                ->sortable(),

        ])
            ->filters([

                SelectFilter::make('type_id')
                    ->label('Categorie')
                    ->options(relationType::where('is_active', 1)->pluck('name', 'id')),
                Tables\Filters\TrashedFilter::make(),

            ],
            )
            ->actions([
                EditAction::make()
                    ->modalHeading('Relatie Bewerken')
                    ->modalDescription('Pas de Relatie leverancier aan door de onderstaande gegevens zo volledig mogelijk in te vullen.')
                    ->tooltip('Bewerken')
                    ->label('Bewerken')
                    ->modalIcon('heroicon-o-pencil')
                    ->slideOver(),
                DeleteAction::make()
                    ->modalIcon('heroicon-o-trash')
                    ->tooltip('Verwijderen')
                    ->label('')
                    ->modalHeading('Verwijderen')
                    ->color('danger'),
                RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make(

                    [Tables\Actions\DeleteBulkAction::make()

                            ->modalHeading('Verwijderen van alle geselecteerde rijen'),

                        RestoreBulkAction::make(),

                    ])])
            ->emptyState(view('partials.empty-state'));
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\EmployeesRelationManager::class,
            RelationManagers\ContactsRelationManager::class,
            RelationManagers\LocationsRelationManager::class,
            RelationManagers\TasksRelationManager::class,
            RelationManagers\NotesRelationManager::class,
            RelationManagers\AttachmentsRelationManager::class,
            RelationManagers\TimeTrackingRelationManager::class,
            RelationManagers\ProjectsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRelations::route('/'),
            // 'edit' => Pages\EditRelation::route('/{record}/edit'),
            'view'  => Pages\ViewRelation::route('/{record}'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ["name", "type.name"];
    }

    public static function getGlobalSearchResultDetails($record): array
    {

        return [
            'Type' => $record?->type->name,
        ];

    }

}
