<?php

namespace App\Filament\Resources\ObjectLocationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactsRelationManager extends RelationManager
{
    protected static string $relationship = 'contactsObject';
    protected static ?string $title = 'Contact Personen';

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
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('contact.first_name')
                ->label('Naam')
                ->getStateUsing(fn ($record): ?string => "{$record->first_name} {$record->last_name}"),
            
                TextColumn::make('contact.email'),
                TextColumn::make('contact.department')->label('Afdeling'),
                TextColumn::make('contact.function')->label('Functie'),
                TextColumn::make('contact.phone_number')
                    ->label('Telefoonnummers')
                    ->description(fn ($record): ?string => $record?->mobile_number ?? null),
            ])
            ->emptyState(view('partials.empty-state-small'))
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('Attach')
                    ->form([
                        Forms\Components\Select::make('contact_id')
                        ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->first_name} {$record->last_name}")

                            ->options(Contact::pluck('first_name', 'id')),
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
                    ->requiresConfirmation()
                    ->action(function (array $data, $record): void {
                        $record->delete();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
