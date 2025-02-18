<?php

namespace App\Filament\Admin\Resources\CompanyResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Mailbox;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Hash;

class MailboxRelationManager extends RelationManager
{
    protected static string $relationship = 'mailboxes'; // Ensure it matches the Company model's relationship

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('server')
                    ->label('Mail Server')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required()
                    ->unique(Mailbox::class, 'email'),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state)), // Encrypt password before storing

                TextInput::make('portnumber')
                    ->label('Port Number')
                    ->numeric()
                    ->required(),

                Select::make('security_protocol')
                    ->label('Security Protocol')
                    ->options([
                        'ssl' => 'SSL',
                        'tls' => 'TLS',
                        'none' => 'None',
                    ])
                    ->required(),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('server')
            ->columns([
                Tables\Columns\TextColumn::make('server')->label('Mail Server')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email Address')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('portnumber')->label('Port')->sortable(),
                Tables\Columns\TextColumn::make('security_protocol')->label('Security Protocol')->sortable(),
            ])
            ->filters([
                // Add any necessary filters here
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
               
            ]);
    }
}
