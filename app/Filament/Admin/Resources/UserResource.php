<?php
namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use STS\FilamentImpersonate\Tables\Actions\Impersonate;

class UserResource extends Resource
{
    protected static bool $isScopedToTenant = false;

    protected static ?string $model           = User::class;
    protected static ?string $navigationIcon  = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Main';
    protected static ?string $navigationLabel = "Gebruikers";
    protected static ?string $pluralModelLabel = 'Gebruikers';


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
                ->unique(User::class, 'email', ignoreRecord: true),

            TextInput::make('password')
                ->label('Wachtwoord')
                ->required()
                ->password()
                ->maxLength(255),

            DatePicker::make('date_of_birth')
                ->label('Geboortedatum')
                ->nullable(),

            Select::make('companies')
                ->label('Bedrijven')
                ->relationship('companies', 'name') // 👈 User belongs to Companies
                ->multiple()
                ->preload(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Naam')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->label('E-mail')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('companies.name')
                    ->label('Bedrijf')
                    ->sortable()
                    ->searchable()
                    ->badge(),

                TextColumn::make('created_at')
                    ->label('Aangemaakt op')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([ActionGroup::make([

                ViewAction::make(),
                EditAction::make(),
                Impersonate::make(),
                Action::make('activities')
                    ->label('Activiteiten')
                    ->icon('heroicon-o-newspaper')
                    ->iconPosition('before')
                    ->color('#C0C0C0')
                    ->url(fn($record) => UserResource::getUrl('activities', ['record' => $record])),])
            ])

            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // You can add relation managers here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'      => Pages\ListUsers::route('/'),
            'create'     => Pages\CreateUser::route('/create'),
            'edit'       => Pages\EditUser::route('/{record}/edit'),
            'activities' => Pages\ListUserActivities::route('/{record}/activities'), // 👈 Add activity page
        ];
    }
}
