<?php
namespace App\Filament\Resources\RelationResource\RelationManagers;

use App\Models\Contact;
use App\Models\ContactObject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use LaraZeus\Tiles\Forms\Components\TileSelect;
use LaraZeus\Tiles\Tables\Columns\TileColumn;

class ContactsRelationManager extends RelationManager
{
    protected static bool $isScopedToTenant = false;
    protected static string $relationship   = 'contactsObject';
    protected static ?string $title         = 'Contactpersonen';

    public function form(Form $form): Form
    {
        return $form
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
            ]);
    }

    public function table(Table $table): Table
    {
        return $table

            ->columns([

                TileColumn::make('contact.name')

                    ->description(fn($record) => $record->contact->email)
                    ->image(fn($record) => $record->contact->avatar),
                //     ->image(fn(User $record) => $record->profile_photo_url),

                TextColumn::make('contact.first_name')
                    ->label('Naam')
                    ->placeholder('-')

                    ->getStateUsing(fn($record): ?string => "{$record->contact->first_name} {$record->contact->last_name}"),

                TextColumn::make('contact.email')
                    ->placeholder('-')
                    ->label('Email'),

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
                            ->searchable(['first_name', 'last_name', 'email'])
                            ->model(Contact::class)
                            ->titleKey('name')
                            ->imageKey('avatar')
                            ->descriptionKey('email')
                            ->label('Contactname')

                        ,

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

            ]);
    }
}
