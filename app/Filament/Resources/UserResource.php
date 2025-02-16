<?php
namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use STS\FilamentImpersonate\Tables\Actions\Impersonate;

class UserResource extends Resource
{
    protected static ?string $model                           = User::class;
    protected static ?string $tenantOwnershipRelationshipName = 'companies';
    protected static ?string $navigationIcon                  = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Naam')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->label('E-mail')
                ->email()
                ->required()
                ->unique(User::class, 'email'),

            TextInput::make('password')
                ->label('Wachtwoord')
                ->password()
                ->required()
                ->minLength(8),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')
                ->label('ID')
                ->sortable(),

            TextColumn::make('name')
                ->label('Naam')
                ->searchable()
                ->sortable(),

            TextColumn::make('email')
                ->label('E-mail')
                ->searchable()
                ->sortable(),

            TextColumn::make('created_at')
                ->label('Aangemaakt op')
                ->dateTime('d-m-Y H:i')
                ->sortable(),
        ])
            ->filters([
                Filter::make('recent')
                    ->label('Nieuwste eerst')
                    ->query(fn(Builder $query) => $query->latest()),
            ])
            ->actions([
                EditAction::make(),
                Impersonate::make(), // <---
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit'   => EditUser::route('/{record}/edit'),
        ];
    }
}
