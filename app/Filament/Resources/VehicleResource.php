<?php
namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Models\Vehicle;
use App\Services\RDWService;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel  = 'Voortuigen';
    protected static ?string $pluralModelLabel = 'Voortuigen';
    protected static ?string $title            = 'Voortuigen';

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

                    ]),

            ]);

        Section::make()
            ->schema([
                // ...
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

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListVehicles::route('/'),
            //  'create' => Pages\CreateVehicle::route('/create'),
            'edit'  => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
