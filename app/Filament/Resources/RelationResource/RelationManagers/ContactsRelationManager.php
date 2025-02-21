<?php
namespace App\Filament\Resources\RelationResource\RelationManagers;

use App\Models\Contact;
use App\Models\ContactObject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
<<<<<<< Updated upstream
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use LaraZeus\Tiles\Forms\Components\TileSelect;
use LaraZeus\Tiles\Tables\Columns\TileColumn;

class ContactsRelationManager extends RelationManager
{
    protected static string $relationship = 'contactsObject';
    protected static ?string $title       = 'Contactpersonen';

=======
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactsRelationManager extends RelationManager
{
    protected static string $relationship = 'contacts';
    protected static ?string $title       = 'Contactpersonen';
>>>>>>> Stashed changes
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->label('Voornaam')
                    ->required()
                    ->maxLength(255),
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
                Forms\Components\TextInput::make('last_name')
                    ->label('Achternaam')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->label('E-mailadres')
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

                Forms\Components\TextInput::make('mobile_number')
                    ->label('Intern telefoonnummer')
                    ->maxLength(255),
<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
            ]);
    }

    public function table(Table $table): Table
    {
        return $table

<<<<<<< Updated upstream
            ->recordUrl(
                function (Object $record) {
                    return "contacts/" . $record->contact_id . "/edit";

                }
            )

            ->columns([

                TileColumn::make('contact.name')
                    ->description(fn($record) => $record->contact->email)
                    ->image(fn($record) => $record->contact->avatar),

                TextColumn::make('contact.department')
                    ->placeholder('-')
                    ->label('Afdeling'),

                TextColumn::make('contact.function')
                    ->placeholder('-')
                    ->label('Functie'),

                TextColumn::make('contact.phone_number')
                    ->placeholder('-')
                    ->label('Telefoonnummers')
                    ->description(fn($record): ?string => $record?->mobile_number ?? null),
            ])
            ->emptyState(view('partials.empty-state-small'))

=======
            ->columns([

                TextColumn::make('name')
                    ->getStateUsing(function ($record): ?string {

                        return $record?->first_name . " " . $record?->last_name;
                    }),

                TextColumn::make('email'),

                Tables\Columns\TextColumn::make("department")
                    ->label("Afdeling"),

                Tables\Columns\TextColumn::make("function")
                    ->label("Functie"),
                Tables\Columns\TextColumn::make("phone_number")
                    ->label("Telefoonnummers")
                    ->description(function ($record): ?string {
                        return $record?->mobile_number ?? null;
                    }),

                // Tables\Columns\TextColumn::make('first_name')   ->label("Naam")

                // ,

                // Tables\Columns\TextColumn::make("email")
                // ->label("E-mailadres"),

            ])->emptyState(view('partials.empty-state-small'))
>>>>>>> Stashed changes
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('Attach')
                    ->modalWidth(MaxWidth::Medium)
                    ->modalHeading('Selecteer Contactpersoons')
                    ->label('Koppel')
                    ->form([

                        TileSelect::make('contact_id')
                            ->model(Contact::class)
                            ->searchable()
                            ->titleKey('first_name')
                            ->imageKey('avatar')
                            ->descriptionKey('email')
                            ->label('Contactpersoon'),

                        // Forms\Components\Select::make('contact_id')
                        //     ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->first_name} {$record->last_name}")

                        //     ->options(Contact::where('company_id', Filament::getTenant()->id

                        //     )->pluck('first_name', 'id')),
                    ])
                    ->action(function (array $data) {
                        ContactObject::create(
                            [
                                'model_id'   => $this->ownerRecord->id,
                                'model'      => 'relation',
                                'contact_id' => $data['contact_id'],
                            ]
                        );
                    }),

            ])
            ->actions([

                Action::make('Detach')
                    ->label('Ontkoppel')
                    ->requiresConfirmation()
                    ->action(function (array $data, $record): void {
                        $record->delete();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
            ]);
    }
}
