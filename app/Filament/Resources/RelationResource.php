<?php
namespace App\Filament\Resources;

use App\Filament\Resources\RelationResource\Pages;
use App\Filament\Resources\RelationResource\RelationManagers;
use App\Models\Relation;
use App\Models\relationType;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
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
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;

class RelationResource extends Resource
{

    protected $listeners            = ["refresh" => '$refresh'];
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

            Forms\Components\Section::make("Locatie gegevens")->schema([Grid::make(4)->schema([Forms\Components\TextInput::make("zipcode")
                    ->label("Postcode")
                    ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])

                    ->maxLength(255)->suffixAction(Action::make("searchAddressByZipcode")
                        ->icon("heroicon-m-magnifying-glass")->action(function (Get $get, Set $set) {
                        $data = (new AddressService())->GetAddress($get("zipcode"), $get("number"));
                        $data = json_decode($data);

                        if (isset($data->error_id)) {
                            Notification::make()
                                ->warning()
                                ->title("Geen resultaten")
                                ->body("Helaas er zijn geen gegevens gevonden bij de postcode <b>" . $get("zipcode") . "</b> Controleer de postcode en probeer opnieuw.")->send();
                        } else {

                            $set("place", $data?->municipality);
                            $set("gps_lat", $data?->lat);
                            $set("gps_lon", $data?->lng);
                            $set("address", $data?->street);
                            $set("municipality", $data?->municipality);
                            $set("province", $data?->province);
                            $set("place", $data?->settlement);

                            $set("construction_year", $data?->constructionYear);
                            $set("surface", $data?->surfaceArea);

                            //check building type ifexist
                            $buildTypeExist = ObjectBuildingType::where('name', '=', $data?->purposes[0])->first();
                            if ($buildTypeExist === null) {
                                $buildingTypeId = ObjectBuildingType::insertGetId(['name' => ucfirst($data?->purposes[0])]);

                            } else {
                                $buildingTypeId = $buildTypeExist->id;
                            }

                            $set("building_type_id", $buildingTypeId);

                        }
                    }))->reactive(),

                Forms\Components\TextInput::make("address")
                    ->label("Adres")
                    ->required()
                    ->columnSpan(2),

                Forms\Components\TextInput::make("place")
                    ->label("Plaats")

                    ->columnSpan(1),

                Forms\Components\TextInput::make("gps_lat")
                    ->label("GPS latitude")

                    ->columnSpan(1)
                    ->hidden(), Forms\Components\TextInput::make("gps_lon")
                    ->label("GPS longitude")
                    ->hidden()
                    ->columnSpan(1),
            ])]),

            Forms\Components\Section::make('Contactgegevens')->schema([
                Grid::make(4)->schema([
                    Forms\Components\TextInput::make("emailaddress")
                        ->label("E-mailadres")
                        ->email()
                        ->columnSpan(2),

                    Forms\Components\TextInput::make("phonenumber")
                        ->label("Telefoonnummer")
                        ->columnSpan(2),

                    Forms\Components\TextInput::make("website")
                        ->label("Website")
                        ->columnSpan(2),
                ]),
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

                            Components\TextEntry::make("address")
                                ->label("Adres")
                                ->getStateUsing(function ($record): ?string {
                                    $housenumber = "";
                                    if ($record?->address) {

                                        return $record?->address . " " . $record?->zipcode . " - " . $record?->place;

                                    } else {
                                        return "Geen locatie toegevoegd";
                                    }
                                })
                                ->placeholder("Niet opgegeven"),

                            Components\TextEntry::make('website')
                                ->label("Website")
                                ->placeholder("Niet opgegeven")
                                ->url(fn($record) => $record->website)
                                ->icon('heroicon-m-link'),
                            Components\TextEntry::make('emailaddress')
                                ->label("E-mailadres")

                                ->url(fn($record) => "mailto:" . $record->emailaddress)
                                ->icon('heroicon-m-envelope')
                                ->placeholder("Niet opgegeven"),

                            Components\TextEntry::make('phonenumber')
                                ->label("Telefoonnummer")
                                ->placeholder("Niet opgegeven")
                                ->url(fn($record) => "tel:" . $record->phonenumber)
                                ->icon('heroicon-m-phone')
                                ->columns(4)])->columns(4),

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
        // ->defaultGroup('type.name')
            ->

        columns([

            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->description(function ($record) {
                    return $record->remark;
                })
                ->weight('medium')
                ->wrap()
                ->alignLeft()
                ->placeholder('-')
                ->label('Bedrijfsnaam'),

            Tables\Columns\TextColumn::make("address")
                ->toggleable()
                ->label("Adres")
                ->description(function ($record) {

                }),

            Tables\Columns\TextColumn::make('zipcode')
                ->placeholder('-')
                ->label('Postcode'),

            Tables\Columns\TextColumn::make('place')
                ->placeholder('-')
                ->label('Plaats'),

            Tables\Columns\TextColumn::make('type.name')
                ->label('Categorie')
                ->columnSpan("full")
                ->badge()
                ->placeholder('-')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('phonenumber')
                ->searchable()
                ->toggleable()
                ->placeholder('-')
                ->url(fn($record) => "tel:" . $record->phonenumber)
                ->icon('heroicon-m-phone')
                ->label('Telefoonnummer'),

            Tables\Columns\TextColumn::make('website')
                ->searchable()
                ->toggleable()
                ->placeholder('-')
                ->url(fn($record) => "https://" . $record->website)
                ->icon('heroicon-m-link')
                ->label('Website'),

            Tables\Columns\TextColumn::make('emailaddress')
                ->searchable()
                ->toggleable()
                ->url(fn($record) => "https://" . $record->emailaddress)
                ->icon('heroicon-m-envelope')
                ->placeholder('-')
                ->label('Emailadres'),

        ])
            ->filters([

                SelectFilter::make('type_id')
                    ->label('Categorie')
                    ->options(relationType::where('is_active', 1)->pluck('name', 'id')),
                Tables\Filters\TrashedFilter::make(),

            ],
            )
            ->actions([

                ViewAction::make()
                    ->label('Bekijk')
                    ->modalIcon('heroicon-o-eye'),

                EditAction::make()
                    ->modalHeading('Relatie Bewerken')
                    ->modalDescription('Pas de Relatie leverancier aan door de onderstaande gegevens zo volledig mogelijk in te vullen.')
                    ->tooltip('Bewerken')
                    ->label('Bewerken')
                    ->modalIcon('heroicon-m-pencil-square')
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
            RelationManagers\TicketRelationManager::class,
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
