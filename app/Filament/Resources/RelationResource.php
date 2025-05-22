<?php
namespace App\Filament\Resources;

use App\Filament\Resources\RelationResource\Pages;
use App\Filament\Resources\RelationResource\RelationManagers;
use App\Models\Relation;
use App\Models\relationType;
use App\Services\AddressService;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set as FilamentSet;
use Filament\Infolists\Components;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group; // Alias toevoegen om conflict te voorkomen
use Filament\Tables\Table;
use Relaticle\CustomFields\Filament\Forms\Components\CustomFieldsComponent;
use Relaticle\CustomFields\Filament\Infolists\CustomFieldsInfolists;

class RelationResource extends Resource
{

    protected $listeners            = ["refresh" => '$refresh'];
    protected static ?string $model = Relation::class;

    protected static ?string $navigationIcon       = 'heroicon-s-building-library';
    protected static ?string $navigationLabel      = "Relaties";
    protected static ?string $pluralModelLabel     = 'Relaties';
    protected static ?string $recordTitleAttribute = 'asdasd';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make()->schema([

                Forms\Components\TextInput::make("name")
                    ->label("Naam organistie")
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
                //     // $cleanZipcode = Str::upper(preg_replace('/\s+/', '', $state));
                //     $set('zipcode', $state);

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

                Forms\Components\Select::make("country")
                    ->label("Land")
                    ->searchable()
                    ->options([
                        'Afghanistan'                                => 'Afghanistan',
                        'Albanië'                                    => 'Albanië',
                        'Algerije'                                   => 'Algerije',
                        'Andorra'                                    => 'Andorra',
                        'Angola'                                     => 'Angola',
                        'Antigua en Barbuda'                         => 'Antigua en Barbuda',
                        'Argentinië'                                 => 'Argentinië',
                        'Armenië'                                    => 'Armenië',
                        'Australië'                                  => 'Australië',
                        'Oostenrijk'                                 => 'Oostenrijk',
                        'Azerbeidzjan'                               => 'Azerbeidzjan',
                        'Bahama\'s'                                  => 'Bahama\'s',
                        'Bahrein'                                    => 'Bahrein',
                        'Bangladesh'                                 => 'Bangladesh',
                        'Barbados'                                   => 'Barbados',
                        'België'                                     => 'België',
                        'Belize'                                     => 'Belize',
                        'Benin'                                      => 'Benin',
                        'Bermuda'                                    => 'Bermuda',
                        'Bhutan'                                     => 'Bhutan',
                        'Bolivia'                                    => 'Bolivia',
                        'Bosnië en Herzegovina'                      => 'Bosnië en Herzegovina',
                        'Botswana'                                   => 'Botswana',
                        'Brazilië'                                   => 'Brazilië',
                        'Brits Territorium in de Indische Oceaan'    => 'Brits Territorium in de Indische Oceaan',
                        'Britse Maagdeneilanden'                     => 'Britse Maagdeneilanden',
                        'Brunei'                                     => 'Brunei',
                        'Bulgarije'                                  => 'Bulgarije',
                        'Burkina Faso'                               => 'Burkina Faso',
                        'Burundi'                                    => 'Burundi',
                        'Cambodja'                                   => 'Cambodja',
                        'Canada'                                     => 'Canada',
                        'Centraal-Afrikaanse Republiek'              => 'Centraal-Afrikaanse Republiek',
                        'Chili'                                      => 'Chili',
                        'China'                                      => 'China',
                        'Christmaseiland'                            => 'Christmaseiland',
                        'Cocoseilanden'                              => 'Cocoseilanden',
                        'Colombia'                                   => 'Colombia',
                        'Comoren'                                    => 'Comoren',
                        'Congo-Brazzaville'                          => 'Congo-Brazzaville',
                        'Congo-Kinshasa'                             => 'Congo-Kinshasa',
                        'Cookeilanden'                               => 'Cookeilanden',
                        'Costa Rica'                                 => 'Costa Rica',
                        'Cuba'                                       => 'Cuba',
                        'Cyprus'                                     => 'Cyprus',
                        'Denemarken'                                 => 'Denemarken',
                        'Djibouti'                                   => 'Djibouti',
                        'Dominica'                                   => 'Dominica',
                        'Dominicaanse Republiek'                     => 'Dominicaanse Republiek',
                        'Duitsland'                                  => 'Duitsland',
                        'Ecuador'                                    => 'Ecuador',
                        'Egypte'                                     => 'Egypte',
                        'El Salvador'                                => 'El Salvador',
                        'Equatoriaal-Guinea'                         => 'Equatoriaal-Guinea',
                        'Eritrea'                                    => 'Eritrea',
                        'Estland'                                    => 'Estland',
                        'Ethiopië'                                   => 'Ethiopië',
                        'Faeröer'                                    => 'Faeröer',
                        'Falklandeilanden'                           => 'Falklandeilanden',
                        'Fiji'                                       => 'Fiji',
                        'Filipijnen'                                 => 'Filipijnen',
                        'Finland'                                    => 'Finland',
                        'Frankrijk'                                  => 'Frankrijk',
                        'Frans-Guyana'                               => 'Frans-Guyana',
                        'Frans-Polynesië'                            => 'Frans-Polynesië',
                        'Franse Zuidelijke en Antarctische Gebieden' => 'Franse Zuidelijke en Antarctische Gebieden',
                        'Gabon'                                      => 'Gabon',
                        'Gambia'                                     => 'Gambia',
                        'Georgië'                                    => 'Georgië',
                        'Ghana'                                      => 'Ghana',
                        'Gibraltar'                                  => 'Gibraltar',
                        'Grenada'                                    => 'Grenada',
                        'Griekenland'                                => 'Griekenland',
                        'Groenland'                                  => 'Groenland',
                        'Guadeloupe'                                 => 'Guadeloupe',
                        'Guernsey'                                   => 'Guernsey',
                        'Guam'                                       => 'Guam',
                        'Guatemala'                                  => 'Guatemala',
                        'Guinee'                                     => 'Guinee',
                        'Guinee-Bissau'                              => 'Guinee-Bissau',
                        'Guyana'                                     => 'Guyana',
                        'Haïti'                                      => 'Haïti',
                        'Honduras'                                   => 'Honduras',
                        'Hongarije'                                  => 'Hongarije',
                        'IJsland'                                    => 'IJsland',
                        'India'                                      => 'India',
                        'Indonesië'                                  => 'Indonesië',
                        'Irak'                                       => 'Irak',
                        'Iran'                                       => 'Iran',
                        'Isle of Man'                                => 'Isle of Man',
                        'Israël'                                     => 'Israël',
                        'Italië'                                     => 'Italië',
                        'Ivoorkust'                                  => 'Ivoorkust',
                        'Jamaica'                                    => 'Jamaica',
                        'Japan'                                      => 'Japan',
                        'Jemen'                                      => 'Jemen',
                        'Jersey'                                     => 'Jersey',
                        'Jordanië'                                   => 'Jordanië',
                        'Kaaimaneilanden'                            => 'Kaaimaneilanden',
                        'Kaapverdië'                                 => 'Kaapverdië',
                        'Kameroen'                                   => 'Kameroen',
                        'Kazachstan'                                 => 'Kazachstan',
                        'Kenia'                                      => 'Kenia',
                        'Kirgizië'                                   => 'Kirgizië',
                        'Kiribati'                                   => 'Kiribati',
                        'Koeweit'                                    => 'Koeweit',
                        'Kroatië'                                    => 'Kroatië',
                        'Laos'                                       => 'Laos',
                        'Lesotho'                                    => 'Lesotho',
                        'Letland'                                    => 'Letland',
                        'Libanon'                                    => 'Libanon',
                        'Liberia'                                    => 'Liberia',
                        'Libië'                                      => 'Libië',
                        'Liechtenstein'                              => 'Liechtenstein',
                        'Litouwen'                                   => 'Litouwen',
                        'Luxemburg'                                  => 'Luxemburg',
                        'Macau'                                      => 'Macau',
                        'Macedonië'                                  => 'Macedonië',
                        'Madagaskar'                                 => 'Madagaskar',
                        'Malawi'                                     => 'Malawi',
                        'Maldiven'                                   => 'Maldiven',
                        'Maleisië'                                   => 'Maleisië',

                    ])
                    ->columnSpan(2),

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
                    ->label("Notitie")
                    ->columnSpan("full"),
            ]),

            // Add the CustomFieldsComponent
            CustomFieldsComponent::make()
                ->columnSpanFull(),

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
                                ->label("Organisatie naam")

                                ->placeholder("Niet opgegeven"),

                            Components\TextEntry::make('type.name')
                                ->label("Categorie")
                                ->badge()
                                ->placeholder("Niet opgegeven"),

                            Components\TextEntry::make("address")
                                ->label("Adres")
                                ->columnSpan(2)
                                ->getStateUsing(function ($record): ?string {
                                    if ($record?->address) {
                                        return $record?->address . " " . $record?->zipcode . " - " . $record?->place;
                                    } else {
                                        return "Geen locatie toegevoegd";
                                    }
                                })
                                ->icon('heroicon-o-clipboard-document')
                                ->placeholder("Niet opgegeven")
                                ->copyable()                       // Enables copy to clipboard
                                ->copyMessage('Adres gekopieerd!') // Success message
                                ->copyMessageDuration(1500)        // Message display duration
                                ->extraAttributes([
                                    'class' => 'cursor-pointer hover:text-primary-500 hover:underline', // Adds underline on hover
                                ]),

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
                                ->icon('heroicon-m-phone'),
                            Components\TextEntry::make('country')
                                ->label("Land")
                                ->placeholder("Niet opgegeven")

                                ->columns(4)])->columns(4),

                ]),

            Section::make()
                ->visible(fn($record) => $record?->remark ?? false)

                ->schema([
                    // ...

                    Components\TextEntry::make('remark')
                        ->label("Notitie")

                        ->placeholder("Geen Notitie"),
                ]),

            // Custom Fields
            CustomFieldsInfolists::make()
                ->columnSpanFull(),

        ]);

    }

    public static function table(Table $table): Table
    {
        return

        // groups([Group::make("type.name")
        //         ->titlePrefixedWithLabel(false)
        //         ->label("Categorie"),

        // ])
        //     ->defaultGroup('type.name')
        //     ->

        $table->columns([

            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->description(function ($record) {
                    return $record->remark;
                })
                ->weight('medium')
                ->wrap()
                ->alignLeft()
                ->placeholder('-')
                ->label('Naam organistie'),

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

            // Tables\Columns\TextColumn::make('website')
            //     ->searchable()
            //     ->toggleable()
            //     ->placeholder('-')
            //     ->url(fn($record) => "https://" . $record->website)
            //     ->icon('heroicon-m-link')
            //     ->label('Website'),

            // Tables\Columns\TextColumn::make('emailaddress')
            //     ->searchable()
            //     ->toggleable()
            //     ->url(fn($record) => "https://" . $record->emailaddress)
            //     ->icon('heroicon-m-envelope')
            //     ->placeholder('-')
            //     ->label('Emailadres'),

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
                Tables\Actions\ActionGroup::make([
                    EditAction::make()
                        ->modalHeading('Contact Bewerken')
                        ->modalDescription('Pas het bestaande contact aan door de onderstaande gegevens zo volledig mogelijk in te vullen.')
                        ->tooltip('Bewerken')
                        ->label('Bewerken')
                        ->modalIcon('heroicon-m-pencil-square')
                    ,
                    DeleteAction::make()
                        ->modalIcon('heroicon-o-trash')
                        ->tooltip('Verwijderen')
                        ->modalHeading('Verwijderen')
                        ->color('danger'),
                ]),
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
            RelationManagers\ObjectsRelationManager::class,
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
