<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObjectLocationResource\Pages;
use App\Filament\Resources\ObjectLocationResource\RelationManagers;
use App\Models\ObjectLocation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\MaxWidth;

//Models
use App\Models\Location;
use App\Models\Customer;
use App\Models\objectBuildingType;
use App\Models\objectManagementCompany;

//Filters
use Filament\Tables\Filters\SelectFilter;

//Form
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\FileUp;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Components\FileUpload;

//Services
use App\Services\AddressService;

//Table
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;

use Filament\Notifications\Notification;

class ObjectLocationResource extends Resource
{
    protected static ?string $model = ObjectLocation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = "Locaties";
    protected static ?string $navigationGroup = "Hoofdmenu";


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([

                    Grid::make(4)->schema([
                        FileUpload::make("image")
                            ->image()
                            ->label("Afbeelding / foto")
                            ->imagePreviewHeight("250")
                            ->loadingIndicatorPosition("left")
                            ->panelAspectRatio("2:1")
                            ->panelLayout("integrated")
                            ->removeUploadedFileButtonPosition("right")
                            ->uploadButtonPosition("left")
                            ->uploadProgressIndicatorPosition("left")
                            ->imageEditor(),

                        Textarea::make("remark")
                            ->rows(7)
                            ->label("Opmerking")
                            ->columnSpan(3)
                            ->autosize(),

                        // ...
                    ]),
                    Grid::make(4)->schema([
                                                Forms\Components\TextInput::make("name")->label("Naam"),
                        Forms\Components\TextInput::make("complexnumber")->label("complexnumber"),

                        Select::make('management_id')
                            ->searchable()
                            ->label('Beheerder')
                            ->options(objectManagementCompany::all()
                                ->pluck('name', 'id')),

                        Select::make('customer_id')
                            ->searchable()
                            ->label('Relatie')
                            ->options(Customer::all()
                                ->pluck('name', 'id')),


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
                                                $set("settlement", $data?->municipality);
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

        Section::make()
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make("image")
                    ->label("")
                    ->width(100),

                Tables\Columns\TextColumn::make("name")->searchable()
                ,
                Tables\Columns\TextColumn::make("zipcode")
                    ->label("Postcode")
                    ->searchable(),
                Tables\Columns\TextColumn::make("address")
                    ->label("Adres")
                    ->searchable(),
                Tables\Columns\TextColumn::make("place")
                    ->label("Plaats")
                    ->searchable(),

                Tables\Columns\TextColumn::make("customer.name")
                    ->label("relatie")
                    ->searchable(),

                Tables\Columns\TextColumn::make("managementcompany.name")
                    ->label("Beheerder")
                    ->searchable(),

                Tables\Columns\TextColumn::make("building_type")
                    ->label("Type")
                    ->badge()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make("building_type_id")
                    ->label("Gebouwtype")
                    ->options(objectBuildingType::all()->pluck("name", "id")),

                SelectFilter::make("management_id")
                    ->label("Beheerder")
                    ->options(objectManagementCompany::all()->pluck("name", "id")),

                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),

                Tables\Actions\EditAction::make()
                    ->modalHeading("Wijzigen")
                    ->modalWidth(MaxWidth::SevenExtraLarge)
                    ->label('Wijzigen')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //      Tables\Actions\DeleteBulkAction::make()->modalHeading('Verwijderen van alle geselecteerde rijen'),
                ]),
            ])
            ->emptyState(view("partials.empty-state"));
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
            'index' => Pages\ListObjectLocations::route('/'),
            'view' => Pages\ViewObjectLocation::route('/{record}'),

        ];
    }


    public static function getModelLabel(): string
    {
        return "Locatie";
    }


    public static function getNavigationGroup(): ?string
    {
        return "Hoofdmenu";
    }
}
