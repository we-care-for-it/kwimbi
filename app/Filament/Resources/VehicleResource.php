<?php
namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Models\gpsObject;
use App\Models\Vehicle;
use App\Services\RDWService;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel  = 'Voertuigen';
    protected static ?string $pluralModelLabel = 'Voertuigen';
    protected static ?string $title            = 'Voertuigen';

    public static function getGloballySearchableAttributes(): array
    {
        return ["kenteken"];
    }

    public static function getModelLabel(): string
    {
        return "Voertuig";
    }

    public static function getGlobalSearchResultDetails($record): array
    {

        return [
            'Voortuig' => $record->voertuigsoort . " . $record->handelsbenaming  " . $record?->model,
            'Kleur'    => $record->eerste_kleur,
            'type'     => $record->inrichting,
            //      'Bestuurder' => $record?->managementcompany->name ?? "-",
        ];

    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make()
                ->collapsible()
                ->description('Live voortuig locatie')
                ->extraAttributes(['class' => 'flush'])
                ->compact()
                ->icon('heroicon-o-map-pin')
                ->schema([
                    ViewEntry::make("imei")
                        ->view("filament.infolists.entries.gpsframe")
                        ->hiddenLabel()
                        ->placeholder("Niet opgegeven"),
                ]),
            Tabs::make('Tabs')
                ->tabs([
                    Tabs\Tab::make('Algemeen')
                        ->icon('heroicon-m-bell')
                        ->schema([
                            TextEntry::make('kenteken')->label('Kenteken'),
                            TextEntry::make('merk')->label('Merk'),
                            TextEntry::make('handelsbenaming')->label('Handelsbenaming'),
                            TextEntry::make('inrichting')->label('Inrichting'),
                            TextEntry::make('eerste_kleur')->label('Eerste Kleur'),
                            TextEntry::make('tweede_kleur')->label('Tweede Kleur'),
                            TextEntry::make('variant')->label('Variant'),
                            TextEntry::make('aantal_deuren')->label('Aantal Deuren'),
                            TextEntry::make('aantal_wielen')->label('Aantal Wielen'),
                            TextEntry::make('aantal_zitplaatsen')->label('Aantal Zitplaatsen'),
                            TextEntry::make('aantal_rolstoelplaatsen')->label('Aantal Rolstoelplaatsen'),
                        ]),
                    Tabs\Tab::make('Datums')
                        ->icon('heroicon-m-bell')
                        ->schema([
                            TextEntry::make('vervaldatum_apk')->label('Vervaldatum APK'),
                            TextEntry::make('datum_tenaamstelling')->label('Datum Tenaamstelling'),
                            TextEntry::make('datum_eerste_toelating')->label('Datum Eerste Toelating'),
                            TextEntry::make('datum_eerste_tenaamstelling_in_nederland')->label('Datum Eerste Tenaamstelling in Nederland'),
                            TextEntry::make('jaar_laatste_registratie_tellerstand')->label('Jaar Laatste Registratie Tellerstand'),
                        ])->columns(3),
                    Tabs\Tab::make('Mileu & Moter')
                        ->icon('heroicon-m-bell')
                        ->schema([
                            TextEntry::make('aantal_cilinders')->label('Aantal Cilinders'),
                            TextEntry::make('cilinderinhoud')->label('Cilinderinhoud'),
                            TextEntry::make('massa_ledig_voortuig')->label('Massa Ledig Voertuig'),
                            TextEntry::make('toegestane_maxium_massa_voortuig')->label('Toegestane Maximum Massa Voertuig'),
                            TextEntry::make('maximum_massa_trekken_ongeremd')->label('Maximum Massa Trekken Ongeremd'),
                            TextEntry::make('maximum_massa_trekken_geremd')->label('Maximum Massa Trekken Geremd'),
                            TextEntry::make('technische_max_massa_voertuig')->label('Technische Max Massa Voertuig'),
                        ])->columns(3),
                ]),
            Tabs::make('Tabs')
                ->tabs([
                    Tabs\Tab::make('Opmerking')
                        ->icon('heroicon-m-bell')
                        ->schema([
                            // ...
                        ]),
                    Tabs\Tab::make('Gebruiker')
                        ->icon('heroicon-m-bell')
                        ->schema([
                            TextEntry::make('title'),
                            TextEntry::make('title'),
                        ]),
                    Tabs\Tab::make('Tankpas')
                        ->icon('heroicon-m-bell')
                        ->schema([
                            TextEntry::make('title'),
                            TextEntry::make('title'),
                        ]),
                    Tabs\Tab::make('Lease maatschappij')
                        ->icon('heroicon-m-bell')
                        ->schema([
                            TextEntry::make('title'),
                            TextEntry::make('title'),
                        ]),
                ]),
        ]);
    }
    

    public static function form(Form $form): Form
    {
        return $form

            ->schema([

                TextInput::make("kenteken")
                    ->label("Kenteken")
                    ->required()
                    ->maxlength(10)
                    ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                    ->suffixAction(

                        Action::make("searchDataByLicenceplate")

                            ->icon("heroicon-m-magnifying-glass")->action(function (Get $get, Set $set) {
                            $data = (new RDWService())->GetVehilcle($get("kenteken"));
                            $data = json_decode($data);

                            if ($data == null) {
                                Notification::make()
                                    ->warning()
                                    ->title("Geen resultaten")
                                    ->body("Helaas er zijn geen gegevens gevonden bij de kenteken <b>" . $get("licenceplate") . "</b> Controleer het kenteken en probeer opnieuw.")->send();
                            } else {
                                $set("voertuigsoort", $data[0]?->voertuigsoort);
                                $set("handelsbenaming", $data[0]?->handelsbenaming);
                                $set("inrichting", $data[0]?->inrichting);
                                $set("variant", $data[0]?->variant);
                                $set("datum_eerste_toelating_dt", $data[0]?->datum_eerste_toelating_dt);
                                $set("eerste_kleur", $data[0]?->eerste_kleur);
                                $set("vervaldatum_apk", date("d-m-Y", strtotime($data[0]?->vervaldatum_apk_dt)));
                                $set("merk", $data[0]?->merk);

                            }

                        })),

                Grid::make(3)
                    ->schema([
                        TextInput::make("voertuigsoort")
                            ->label("Voertuigsoort"),

                        TextInput::make("merk")
                            ->label("Merk"),

                        TextInput::make("handelsbenaming")
                            ->label("Handelsbenaming"),

                        TextInput::make("inrichting")
                            ->label("Inrichting"),

                        TextInput::make("eerste_kleur")
                            ->label("Kleur"),
                        TextInput::make("inrichting")
                            ->label("inrichting"),

                        TextInput::make("variant")
                            ->label("Variant"),

                        TextInput::make("vervaldatum_apk")
                            ->label("Vervaldatum APK")
                        ,

                        Select::make('gps_object_id')
                            ->label('GPS Tracker')
                            ->options(gpsObject::pluck('imei', 'id'))
                            ->searchable(),

                    ]),

            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable()
                    ->getStateUsing(function ($record): ?string {
                        return sprintf('%06d', $record?->id);
                    }),

                Tables\Columns\TextColumn::make('kenteken')
                    ->sortable()
                    ->toggleable()
                    ->label('Kenteken'),

                Tables\Columns\TextColumn::make('merk')
                    ->sortable()
                    ->toggleable()
                    ->label('Merk'),

                Tables\Columns\TextColumn::make('handelsbenaming')
                    ->sortable()
                    ->toggleable()
                    ->label('handelsbenaming'),

                Tables\Columns\TextColumn::make('variant')
                    ->sortable()
                    ->toggleable()
                    ->label('variant'),

                Tables\Columns\TextColumn::make('inrichting')
                    ->sortable()
                    ->toggleable()
                    ->label('inrichting'),

                Tables\Columns\TextColumn::make('eerste_kleur')
                    ->sortable()
                    ->toggleable()
                    ->label('kleur'),

                Tables\Columns\TextColumn::make('vervaldatum_apk')
                    ->color(
                        fn($record) => strtotime($record?->vervaldatum_apk) <
                        time()
                        ? "danger"
                        : "success"
                    )
                    ->date('d-m-Y')
                    ->sortable()
                    ->toggleable()
                    ->label('Vervaldatum APK'),

                Tables\Columns\TextColumn::make('GPSObject.imei')
                    ->sortable()
                    ->toggleable()
                    ->badge()
                    ->label('Tracker'),

            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()
                    ->modalHeading('Voortuig snel bewerken')
                    ->modalIcon('heroicon-o-pencil')
                    ->label('Snel bewerken')
                    ->slideOver(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->emptyState(view("partials.empty-state"));
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\GpsDataRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            "view"  => Pages\ViewVehicle::route("/{record}"),
        ];
    }

}
