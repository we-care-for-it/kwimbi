<?php
namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Models\Vehicle;
use App\Services\RDWService;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

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
            'Voertuig' => $record->voertuigsoort . " . $record->handelsbenaming  " . $record?->model,
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
                ->description('Live voertuig locatie')
                ->extraAttributes(['class' => 'flush'])
                ->compact()
                ->icon('heroicon-o-map-pin')
                ->schema([
                    ViewEntry::make("imei")
                        ->view("filament.infolists.entries.gpsframe")
                        ->hiddenLabel()
                        ->placeholder("Niet opgegeven"),
                ]),

            Tabs::make('Tabs')->tabs([
                Tabs\Tab::make('Algemeen')
                    ->icon('heroicon-m-bell')
                    ->schema([
                        TextEntry::make('kenteken')
                            ->label('Kenteken')
                            ->placeholder('-'),
                        TextEntry::make('merk')->label('Merk')->placeholder('-'),
                        TextEntry::make('handelsbenaming')->label('Handelsbenaming')->placeholder('-'),
                        TextEntry::make('inrichting')->label('Inrichting')->placeholder('-'),
                        TextEntry::make('eerste_kleur')->label('Eerste Kleur')->placeholder('-'),
                        TextEntry::make('tweede_kleur')->label('Tweede Kleur')->placeholder('-'),
                        TextEntry::make('variant')->label('Variant')->placeholder('-'),
                        TextEntry::make('aantal_deuren')->label('Aantal Deuren')->placeholder('-'),
                        TextEntry::make('aantal_wielen')->label('Aantal Wielen')->placeholder('-'),
                        TextEntry::make('aantal_zitplaatsen')->label('Aantal Zitplaatsen')->placeholder('-'),
                        TextEntry::make('aantal_rolstoelplaatsen')->label('Aantal Rolstoelplaatsen')->placeholder('-'),
                        ImageEntry::make('attachments')->label('Afbeelding')->placeholder('-'),
                    ])->columns(3),

                Tabs\Tab::make('Datums')
                    ->icon('heroicon-m-bell')
                    ->schema([
                        TextEntry::make('vervaldatum_apk')->label('Vervaldatum APK')->placeholder('-'),
                        TextEntry::make('datum_tenaamstelling')->label('Datum Tenaamstelling')->placeholder('-'),
                        TextEntry::make('datum_eerste_toelating')->label('Datum Eerste Toelating')->placeholder('-'),
                        TextEntry::make('datum_eerste_tenaamstelling_in_nederland')->label('Datum Eerste Tenaamstelling in Nederland')->placeholder('-'),
                        TextEntry::make('jaar_laatste_registratie_tellerstand')->label('Jaar Laatste Registratie Tellerstand')->placeholder('-'),
                    ])->columns(3),

                Tabs\Tab::make('Mileu & Moter')
                    ->icon('heroicon-m-bell')
                    ->schema([
                        TextEntry::make('aantal_cilinders')->label('Aantal Cilinders')->placeholder('-'),
                        TextEntry::make('cilinderinhoud')->label('Cilinderinhoud')->placeholder('-'),
                        TextEntry::make('massa_ledig_voertuig')->label('Massa Ledig Voertuig')->placeholder('-'),
                        TextEntry::make('toegestane_maximum_massa_voertuig')->label('Toegestane Maximum Massa Voertuig')->placeholder('-'),
                        TextEntry::make('maximum_massa_trekken_ongeremd')->label('Maximum Massa Trekken Ongeremd')->placeholder('-'),
                        TextEntry::make('maximum_massa_trekken_geremd')->label('Maximum Massa Trekken Geremd')->placeholder('-'),
                        TextEntry::make('technische_max_massa_voertuig')->label('Technische Max Massa Voertuig')->placeholder('-'),
                    ])->columns(3),
            ]),

            Tabs::make('Tabs')->tabs([
                Tabs\Tab::make('Opmerking')
                    ->icon('heroicon-m-bell')
                    ->schema([
                        // ...
                    ]),

                Tabs\Tab::make('Gebruiker')
                    ->icon('heroicon-m-bell')
                    ->schema([
                        TextEntry::make('title')->placeholder('-'),
                        TextEntry::make('title')->placeholder('-'),
                    ]),

                Tabs\Tab::make('Tankpas')
                    ->icon('heroicon-m-bell')
                    ->schema([
                        TextEntry::make('title')->placeholder('-'),
                        TextEntry::make('title')->placeholder('-'),
                    ]),

                Tabs\Tab::make('Lease maatschappij')
                    ->icon('heroicon-m-bell')
                    ->schema([
                        TextEntry::make('title')->placeholder('-'),
                        TextEntry::make('title')->placeholder('-'),
                    ]),
            ]),
        ]);
    }

    public static function form(Form $form): Form
    {
        return $form

            ->schema([

                TextInput::make("kenteken")
                    ->unique(Vehicle::class, 'kenteken', ignoreRecord: true)
                    ->label("Kenteken")
                    ->required()
                    ->maxlength(10)
                    ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                    ->suffixAction(

                        Action::make("searchDataByLicenceplate")

                            ->icon("heroicon-m-magnifying-glass")->action(function (Get $get, Set $set) {
                            $data = (new RDWService())->GetVehicle($get("kenteken"));
                            $data = json_decode($data);

                            if ($data == null) {
                                Notification::make()
                                    ->warning()
                                    ->title("Geen resultaten")
                                    ->body("Helaas er zijn geen gegevens gevonden bij de kenteken <b>" . $get("licenceplate") . "</b> Controleer het kenteken en probeer opnieuw.")->send();
                            } else {
                                $set("voertuigsoort", $data[0]?->voertuigsoort ?? 'Onbekend');
                                $set("handelsbenaming", $data[0]?->handelsbenaming ?? 'Onbekend');
                                $set("inrichting", $data[0]?->inrichting ?? 'Onbekend');
                                $set("variant", $data[0]?->variant ?? 'Onbekend');
                                $set("datum_eerste_toelating_dt", $data[0]?->datum_eerste_toelating_dt ?? 'Onbekend');
                                $set("eerste_kleur", $data[0]?->eerste_kleur ?? 'Onbekend');
                                $set("vervaldatum_apk", date("d-m-Y", strtotime($data[0]?->vervaldatum_apk_dt ?? 'Onbekend')));
                                $set("merk", $data[0]?->merk ?? 'Onbekend');

                            }

                        })),

                Grid::make(3)
                    ->schema([

                        // FileUpload::make('attachments')
                        //     ->directory('vehicles'),

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
                            ->label("Vervaldatum APK"),
                            
                        Forms\Components\Section::make("Afbeeldingen")
                            ->description('Afbeeldingen van het gebouw')
                            ->compact()
                            ->schema([
            
                                SpatieMediaLibraryFileUpload::make('buildingimage')
                                    ->responsiveImages()
                                    ->image()
                                    ->hiddenlabel()
                                    ->panelLayout('grid')
                                    ->maxFiles(8)
                                    ->label('Afbeeldingen')
                                    ->multiple()
                                    ->collection('buildingimages'),
            
                            ])
                            ->collapsible()
                            ->collapsed(false)
                            ->persistCollapsed()
                            ->columns(1),
                    ]),
                    
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                // Tables\Columns\TextColumn::make('id')
                //     ->label('#')
                //     ->sortable()
                //     ->getStateUsing(function ($record): ?string {
                //         return sprintf('%06d', $record?->id);
                //     }),
                ImageColumn::make('attachments')
                    ->label('Afbeelding')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('kenteken')
                    ->sortable()
                    ->toggleable()
                    ->placeholder('-')
                    ->label('Kenteken'),

                Tables\Columns\TextColumn::make('merk')
                    ->sortable()
                    ->placeholder('-')
                    ->toggleable()
                    ->label('Merk'),

                Tables\Columns\TextColumn::make('handelsbenaming')
                    ->sortable()
                    ->toggleable()
                    ->placeholder('-')
                    ->label('handelsbenaming'),

                Tables\Columns\TextColumn::make('variant')
                    ->sortable()
                    ->toggleable()
                    ->placeholder('-')
                    ->label('variant'),

                Tables\Columns\TextColumn::make('inrichting')
                    ->sortable()
                    ->toggleable()
                    ->placeholder('-')
                    ->label('Inrichting'),

                Tables\Columns\TextColumn::make('eerste_kleur')
                    ->sortable()
                    ->placeholder('-')
                    ->toggleable()
                    ->label('Kleur'),

                Tables\Columns\TextColumn::make('vervaldatum_apk')
                    ->color(
                        fn($record) => strtotime($record?->vervaldatum_apk) <
                        time()
                        ? "danger"
                        : "success"
                    )
                    ->date('d-m-Y')
                    ->sortable()
                    ->placeholder('-')
                    ->toggleable()
                    ->label('Vervaldatum APK'),

                Tables\Columns\TextColumn::make('GPSObject.imei')
                    ->sortable()
                    ->toggleable()
                    ->placeholder('Geen tracker gekoppeld')
                    ->badge()
                    ->label('Tracker'),

            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                EditAction::make()
                    ->modalHeading('Voertuig snel bewerken')
                    ->modalIcon('heroicon-o-pencil')
                    ->label('Snel bewerken')
                    ->slideOver(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
