<?php
namespace App\Filament\Resources\RelationResource\RelationManagers;

use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use LaraZeus\Tiles\Tables\Columns\TileColumn;

class ContactsRelationManager extends RelationManager
{
    protected static bool $isScopedToTenant = false;
    protected static string $relationship   = 'contacts';
    protected static ?string $icon          = 'heroicon-o-user';
    protected static ?string $title         = 'Contactpersonen';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        // $ownerModel is of actual type Job
        return $ownerRecord->contacts->count();
    }

    public function form(Form $form): Form
    {
        return $form

            ->schema([

                Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->label('Voornaam')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('last_name')
                            ->label('Achternaam')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('E-mailadres')
                            ->email()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('department')
                            ->label('Afdeling')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('function')
                            ->label('Functie')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('phone_number')
                            ->label('Telefoonnummer')
                            ->maxLength(255),

                    ]),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table

            ->columns([

                TileColumn::make('name')
                    ->description(fn($record) => $record->function)
                    ->sortable()
                    ->image(fn($record) => $record->avatar),

                TextColumn::make('email')
                    ->placeholder('-')
                    ->Url(function (object $record) {
                        return "mailto:" . $record?->email;
                    })
                    ->label('Emailadres'),

                TextColumn::make('department')
                    ->placeholder('-')
                    ->sortable()
                    ->label('Afdeling'),

                TextColumn::make('function')
                    ->placeholder('-')
                    ->sortable()
                    ->label('Functie'),

                TextColumn::make('phone_number')
                    ->placeholder('-')
                    ->Url(function (object $record) {
                        return "tel:" . $record?->contact?->phone_number;
                    })
                    ->label('Telefoonnummers')
                    ->description(fn($record): ?string => $record?->mobile_number ?? null),
            ])

            // ->recordUrl(Contact::getUrl('edit', ['record' => auth()->user()])

            //  route('filament.resources.contacts.edit', ['tenant' => filament()->getTenant()])
            //   )

            ->emptyState(view('partials.empty-state-small'))

            ->filters([
                //
            ])
            ->headerActions([

                Tables\Actions\CreateAction::make('createContact')
                    ->label('Toevoegen')
                    ->modalHeading('Contactpersoon toevoegen')

                // ->mutateFormDataUsing(function (array $data): array {
                //     //Maak de contactpersoon aan
                //     $contact_id = Contact::insertGetId([
                //         'first_name'   => $data['first_name'],
                //         'last_name'    => $data['last_name'],
                //         'department'   => $data['department'],
                //         'email'        => $data['email'],
                //         'function'     => $data['function'],
                //         'phone_number' => $data['phone_number'],
                //     ]);

                //     ContactObject::create([
                //         'model'      => 'location',
                //         'contact_id' => $contact_id,
                //         'model_id'   => $this->getOwnerRecord()->id,
                //     ]);

                //     return $data;
                // })
                    ->slideOver()

                ,

                // Action::make('Attach')
                //     ->modalWidth(MaxWidth::Large)
                //     ->modalHeading('Contactpersoon toevoegen')
                //     ->modalDescription('Koppel een bestaand contactpersoon aan deze relatie ')
                //     ->label('Koppel bestaand contact')
                //     ->form([

                //         TileSelect::make('contact_id')
                //             ->searchable(['first_name', 'last_name', 'email'])
                //             ->model(Contact::class)
                //             ->titleKey('name')
                //             ->imageKey('avatar')
                //             ->descriptionKey('email')
                //             ->label('Contactpersoon')

                //         ,

                //     ]),
                // ->action(function (array $data) {
                //     ContactObject::create(
                //         [
                //             'model_id'   => $this->ownerRecord->id,
                //             'model'      => 'relation',
                //             'contact_id' => $data['contact_id'],
                //         ]
                //     );
                // }),

            ])

            ->actions([

                Action::make('openContact')
                    ->label('Bekijk contact')

                    ->color('primary')
                    ->url(function ($record) {
                        return "/contacts/" . $record->contact_id;
                    })->icon('heroicon-s-eye'),

                EditAction::make()
                    ->label('Bewerken')->color('success'),
                // DeleteAction::make('Detach')
                //     ->label('Verwijderen')
                //     ->modalHeading('Contactpersonen ontkoppelen van deze ')
                //     ->label('')
                //     ->requiresConfirmation()
                //     ->action(function (array $data, $record): void {
                //         $record->delete();
                //     }),

            ])
            ->bulkActions([

            ]);
    }
}
