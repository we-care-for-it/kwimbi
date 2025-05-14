<?php
namespace App\Filament\Resources\ProjectsResource\RelationManagers;

use App\Enums\QuoteStatus;
use App\Enums\QuoteTypes;
use App\Models\Relation;
use App\Models\relationType;
use App\Services\AddressService;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set as FilamentSet;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class QuotesRelationManager extends RelationManager
{
    protected static string $relationship = 'quotes';
    protected static ?string $title       = 'Offertes';
    protected static ?string $icon        = 'heroicon-o-currency-euro';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        // $ownerModel is of actual type Job
        return $ownerRecord->quotes->count();
    }

    public function form(Form $form): Form
    {
        return $form->schema([Section::make()
                ->schema([

                    Select::make("type_id")
                        ->label("Type")
                        ->required()
                        ->reactive()
                        ->options(QuoteTypes::class)
                        ->columnSpan("full")
                        ->default('1'),

                    Select::make("company_id")

                        ->options(function () {
                            return \App\Models\Relation::all()
                                ->groupBy('type.name')
                                ->mapWithKeys(function ($group, $category) {
                                    return [
                                        $category => $group->pluck('name', 'id')->toArray(),
                                    ];
                                })->toArray();
                        })
                        ->createOptionForm([
                            Forms\Components\Section::make()->schema([

                                Forms\Components\TextInput::make("name")
                                    ->label("Naam / Bedrijfsnaam")
                                    ->required()

                                    ->columnSpan("full"),

                                Forms\Components\Select::make('type_id')
                                    ->required()
                                    ->label("Categorie")
                                    ->options(RelationType::where('is_active', 1)->pluck('name', 'id')),

                                //])
                                // ->columns(3)
                                // ->columnSpan(4),
                            ]),

                            Forms\Components\Section::make("Locatie gegevens")->schema([Grid::make(4)->schema([

                                TextInput::make('zipcode')
                                    ->label('Postcode')
                                    ->required()
                                    ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase().replace(/\s+/g, "")'])

                                    ->maxLength(6)
                                    ->live(onBlur: true)
                                // ->afterStateUpdated(function ($state, FilamentSet $set) {
                                //     // Verwijder spaties en zet om naar hoofdletters
                                //     $cleanZipcode = Str::upper(preg_replace('/\s+/', '', $state));
                                //     $set('zipcode', $cleanZipcode);

                                // })
                                    ->rule('regex:/^[1-9][0-9]{3} ?[a-zA-Z]{2}$/')
                                    ->suffixAction(
                                        Action::make('searchAddressByZipcode')
                                            ->icon('heroicon-m-magnifying-glass')
                                            ->action(function ($get, FilamentSet $set) {
                                                $zipcode = preg_replace('/\s+/', '', $get('zipcode'));
                                                $data    = (new AddressService())->GetAddress($zipcode, $get('number'));
                                                $data    = json_decode($data);

                                                if (isset($data->error_id)) {
                                                    Notification::make()
                                                        ->warning()
                                                        ->title('Geen resultaten')
                                                        ->body('Geen adres gevonden voor deze postcode/huisnummer combinatie')
                                                        ->send();
                                                } else {
                                                    $set('place', $data?->municipality);
                                                    $set('address', $data?->street);
                                                }
                                            })
                                    ),

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
                                        ->numeric() // Alleen cijfers toestaan
                                        ->maxLength(10)
                                        ->mutateDehydratedStateUsing(fn($state) => preg_replace('/[^0-9]/', '', $state))
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

                        ])
                        ->createOptionUsing(function (array $data): int {
                            return Relation::create($data)->getKey();
                        })

                        ->label('Relatie')
                        ->searchable()
                        ->columnSpan("full"),
                    TextInput::make("number")
                        ->label("Nummer")
                        ->placeholder('-'),

                    TextInput::make("Price")
                        ->label("Prijs")
                        ->placeholder('-')
                        ->numeric()
                        ->prefix('€'),

                ])
                ->columns(2)
                ->columnSpan(1),

            Section::make()
                ->schema([

                    DatePicker::make("request_date")
                        ->default(now())
                        ->label("Offerte datum")
                        ->required(),

                    DatePicker::make("remembered_at")
                        ->label("herinnert op")
                        ->placeholder('-'),

                    DatePicker::make("accepted_at")
                        ->label("Geaccepteerd op")
                        ->placeholder('-'),

                    DatePicker::make("end_date")
                        ->label("Einddatum"),

                    Select::make("status_id")
                        ->label("Status")
                        ->required()
                        ->options(QuoteStatus::class)
                        ->columnSpan("full"),

                ])
                ->columns(2)
                ->columnSpan(1),

            Section::make()
                ->schema([Forms\Components\TextInput::make("remark")
                        ->label("Opmerking")
                        ->maxLength(255)
                        ->columnSpan("full"),
                ])
                ->columns(2)
                ->columnSpan(2),

            Section::make()->schema([FileUpload::make('attachment')
                    ->label('Bijlage')
                    ->columnSpan(3)
                    ->preserveFilenames()
                    ->visibility('private')->directory(function () {
                    $parent_id = $this->getOwnerRecord()->id;
                    return '/uploads/project/' . $parent_id . '/quotes';
                })])->columns(2)
                ->columnSpan(2),

        ]);

    }

    public function table(Table $table):
    Table {
        return $table->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make("request_date")
                    ->dateTime("d-m-Y")
                    ->label("Offertedatum"), Tables\Columns\TextColumn::make("number")
                    ->label('Nummer'),

                Tables\Columns\TextColumn::make("supplier.name")
                    ->label("Leverancier")
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make("status.name")
                    ->label("Status")
                    ->badge()
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make("price")
                    ->label("Prijs")
                    ->prefix('€')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make("remembered_at")
                    ->label("Herinnering verstuurd")
                    ->dateTime("d-m-Y")
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make("accepted_at")
                    ->label("Accepteer datum ")
                    ->dateTime("d-m-Y")
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make("end_date")
                    ->label("Einddatum")
                    ->dateTime("d-m-Y")
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make("type_id")
                    ->label("Type")
                    ->badge(),
            ])->emptyState(view('partials.empty-state-small'))
            ->filters([
                //
            ])
            ->headerActions([Tables\Actions\CreateAction::make()
                    ->label("Offerte toevoegen")
                    ->modalHeading('Offerte toevoegen')
                    ->modalDescription('Geef de gegevens van de offerte in het onderstaande formulier')
                    ->modalWidth(MaxWidth::SixExtraLarge)])

            ->actions([

                Tables\Actions\EditAction::make()
                    ->modalWidth(MaxWidth::SixExtraLarge), Tables\Actions\DeleteAction::make()
                    ->modalHeading('Offerte toevoegen')
                    ->label('')])
            ->bulkActions([
                //                Tables\Actions\BulkActionGroup::make([
                //                    Tables\Actions\DeleteBulkAction::make(),
                //                ]),
            ]);
    }
}
