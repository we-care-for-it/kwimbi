<?php

namespace App\Filament\Resources\RelationResource\RelationManagers;

use Filament\Panel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Layout\Split;
use App\Models\Contact;
use App\Models\ContactObject;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Columns\TextColumn;
use Filament\Facades\Filament;

class ContactsRelationManager extends RelationManager
{
    protected static string $relationship = 'contactsObject';
    protected static ?string $title = 'Contactpersonen';

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
                ImageColumn::make('image')
                    ->label('Profielfoto')
                    ->circular()
                    ->defaultImageUrl(url('/images/noavatar.jpg')),

                TextColumn::make('contact.first_name')
                    ->label('Naam')
                    ->placeholder('-')
                    ->getStateUsing(fn ($record): ?string => "{$record->contact->first_name} {$record->contact->last_name}"),
            
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
                    ->description(fn ($record): ?string => $record?->mobile_number ?? null),
            ])
            ->emptyState(view('partials.empty-state-small'))
    
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('Attach')
                ->modalWidth(MaxWidth::Medium)
                ->modalHeading('Selecteer Contactpersoon')
                ->label('Koppel')
                    ->form([
                        Forms\Components\Select::make('contact_id')
                        ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->first_name} {$record->last_name}")

                            ->options(Contact::where('company_id', Filament::getTenant()->id

                            )->pluck('first_name', 'id')),
                    ])
                    ->action(function (array $data) {
                        ContactObject::create(
                            [
                                'model_id' => $this->ownerRecord->id,
                                'model' => 'relation',
                                'contact_id' => $data['contact_id']
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
