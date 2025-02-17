<?php

namespace App\Filament\Admin\Resources\CompanyResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Columns\TextColumn;
use App\Models\CompanyUsers;
use App\Models\User;

class UsersRelationManager extends RelationManager
{
    protected static bool $isScopedToTenant = false;

    protected static string $relationship = 'companyUsers'; 

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->label('Email Address')
                ->email()
                ->required()
                ->unique(User::class, 'email'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('user.email')
                    ->label('Email Address')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Action::make('Detach')
                    ->requiresConfirmation()
                    ->action(function (array $data, $record): void {
                        $record->delete();
                    }),
            ])
            ->headerActions([
                Action::make('Attach')
                    ->form([
                        Forms\Components\Select::make('user_id')
                            ->options(User::pluck('name', 'id')),
                    ])
                    ->action(function (array $data) {
                        CompanyUsers::create(
                            [
                                'company_id' => $this->ownerRecord->id,
                                'user_id' => $data['user_id']

                            ]
                        );
                    }),
            ]);
    }
}
