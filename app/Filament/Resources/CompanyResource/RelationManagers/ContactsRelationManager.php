<?php

namespace App\Filament\Resources\CompanyResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Notifications\Notification;

class ContactsRelationManager extends RelationManager
{
    protected static string $relationship = 'contacts';
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
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('first_name')->getStateUsing(function ($record) : ? string
                {
                 
        
                    return $record?->first_name . " " . $record?->last_name;
                })    ->label("Naam")
                
                ,

                Tables\Columns\TextColumn::make("email")
                ->label("E-mailadres"),

                Tables\Columns\TextColumn::make("department")
                ->label("Afdeling"),

                Tables\Columns\TextColumn::make("function")
                ->label("Functies"),



                ])->emptyState(view('partials.empty-state-small'))
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->slideOver(),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make()
                        ->modalHeading('Snel bewerken')
                        ->modalIcon('heroicon-o-pencil')
                        ->label('Snel bewerken')
                        ->slideOver(),
                    DeleteAction::make()
                        ->modalIcon('heroicon-o-trash')
                        ->modalHeading('Object verwijderen')
                        ->color('danger'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
