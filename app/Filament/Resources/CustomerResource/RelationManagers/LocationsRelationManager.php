<?php
namespace App\Filament\Resources\CustomerResource\RelationManagers;

use App\Models\ObjectLocation;
use App\Models\ObjectManagementCompany;
use App\Services\AddressService;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LocationsRelationManager extends RelationManager
{
    protected static string $relationship = 'Locations';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([

                    Grid::make(4)->schema([
                        Forms\Components\TextInput::make("name")->label("Naam"),
                        Forms\Components\TextInput::make("Complexnumber")->label("complexnumber"),

                        Select::make('management_id')
                            ->searchable()
                            ->label('Beheerder')
                            ->options(ObjectManagementCompany::all()
                                    ->pluck('name', 'id'))
                            ->columnSpan(2),
//
//                        Select::make('customer_id')
//                            ->searchable()
//                            ->label('Relatie')
//                            ->options(Customer::all()
//                                ->pluck('name', 'id')),

                    ]),

                    // ...
                ]),

                Forms\Components\Section::make("Locatie gegevens")
                    ->schema([
                        Grid::make(4)->schema([
                            Forms\Components\TextInput::make("zipcode")
                                ->label("Postcode")
                                ->maxLength(255)
                                ->suffixAction(
                                    Action::make("searchAddressByZipcode")
                                        ->icon("heroicon-m-magnifying-glass")
                                        ->action(function (Get $get, Set $set) {

                                            $data = (new AddressService())->GetAddress(
                                                $get("zipcode"),
                                                $get("number")
                                            );
                                            $data = json_decode($data);

                                            if (isset($data->error_id)) {
                                                Notification::make()
                                                    ->warning()
                                                    ->title("Geen resultaten")
                                                    ->body(
                                                        "Helaas er zijn geen gegevens gevonden bij de postcode <b>" .
                                                        $get("zipcode") .
                                                        "</b> Controleer de postcode en probeer opnieuw."
                                                    )
                                                    ->send();
                                            } else {
                                                //dd($data);
                                                $set("place", $data?->municipality);
                                                $set("gps_lat", $data?->lat);
                                                $set("gps_lon", $data?->lng);
                                                $set("address", $data?->street);
                                                $set("municipality", $data?->municipality);
                                                $set("province", $data?->province);
                                                $set("place", $data?->settlement);
                                                $set("building_type", $data?->purposes[0]);
                                                $set("construction_year", $data?->constructionYear);
                                                $set("surface", $data?->surfaceArea);

                                            }
                                        })
                                ),

                            Forms\Components\TextInput::make("address")
                                ->label("Straatnaam")
                                ->columnSpan(2),

                            Forms\Components\TextInput::make(
                                "housenumber"
                            )->label("Huisnummer"),

                            Forms\Components\TextInput::make("place")->label(
                                "Plaats"
                            ),

                            Forms\Components\TextInput::make("province")->label(
                                "Provincie"
                            ),

                            Forms\Components\TextInput::make("gps_lat")
                                ->label("GPS latitude")
                                ->columnSpan(1),

                            Forms\Components\TextInput::make("gps_lon")
                                ->label("GPS longitude")
                                ->columnSpan(1),

                            // ...
                        ]),
                    ])
                    ->columns(2)
                    ->columnSpan(2),

                Forms\Components\Section::make("Gebouwgegevens")
                    ->schema([
                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\TextInput::make(
                                "construction_year"
                            )->label("Bouwjaar"),

                            Forms\Components\TextInput::make("levels")->label(
                                "Verdiepingen"
                            ),

                            Forms\Components\TextInput::make("surface")->label(
                                "Aantal m2"
                            ),

                            Forms\Components\TextInput::make("building_type")
                                ->label("Gebouwtype")
                                ->columnSpan(3),
                        ]),
                    ])
                    ->columnSpan(["lg" => 1]),
            ])
            ->columns(3);

    }

    public function table(Table $table): Table
    {
        return $table

            ->columns([
                Tables\Columns\TextColumn::make('address')
                    ->getStateUsing(function (ObjectLocation $record): ?string {

                        if ($record?->name) {
                            return $record?->name;
                        } else {
                            return $record->address . " - " . $record->zipcode . " - " . $record->place;
                        }
                    })
                    ->searchable()
                    ->label('Adres')
                    ->description(function (ObjectLocation $record) {

                        if (! $record?->name) {
                            return $record?->name;
                        } else {
                            return $record->address . " - " . $record->zipcode . "  " . $record->place;
                        }

                    }
                    ),

                Tables\Columns\TextColumn::make('zipcode')
                    ->label('Postcode')->searchable()->hidden(true),

                Tables\Columns\TextColumn::make('place')
                    ->label('Plaats')->searchable()->hidden(true),

                TextColumn::make('objects_count')->counts('objects')->label('Objecten')->sortable()->badge()->alignment(Alignment::Center)->color('success'),
                TextColumn::make('notes_count')->counts('notes')->label('Notites')->sortable()->badge()->alignment(Alignment::Center)->color('success'),
                TextColumn::make('attachments_count')->counts('attachments')->label('Bijlages')->sortable()->badge()->alignment(Alignment::Center)->color('success'),

                Tables\Columns\TextColumn::make("managementcompany.name")->sortable()
                    ->label("Beheerder")->placeholder('Geen beheer gekoppeld')
                    ->searchable(),

                Tables\Columns\TextColumn::make("building_type")->sortable()
                    ->label("Gebouwtype")
                    ->badge()
                    ->searchable()
                    ->placeholder('Onbekend'),
                // Tables\Columns\TextColumn::make('phonenumber')
                // ->label('Telefoonnummer')
                // ->searchable()
                // ->sortable(),

            ])
            ->filters([

                Tables\Filters\TrashedFilter::make(),
            ])->filtersFormColumns(3)

            ->headerActions([Tables\Actions\CreateAction::make()
                    ->label("Toevoegen")
                    ->modalWidth(MaxWidth::SixExtraLarge)])

            // layout: FiltersLayout::AboveContent
            ->actions([

                Tables\Actions\Action::make('Download')
                    ->label('Open locatie')->color('success')->icon('heroicon-m-eye')
                    ->url(function (ObjectLocation $record) {
                        return "/app/object-locations/" .
                        $record->id;
                    }),

                Tables\Actions\EditAction::make()->modalWidth(MaxWidth::SixExtraLarge),
                Tables\Actions\DeleteAction::make()
                    ->label(""),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([

                    //    ExportBulkAction::make(),

                    //      Tables\Actions\DeleteBulkAction::make()->modalHeading('Verwijderen van alle geselecteerde rijen'),
                ]),
            ])
            ->emptyState(view("partials.empty-state"));

    }
}
