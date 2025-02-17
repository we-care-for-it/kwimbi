<?php
namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Models\User;
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
use Illuminate\Support\Facades\Hash;
use STS\FilamentImpersonate\Tables\Actions\Impersonate;



class UserResource extends Resource
{
    protected static bool $isScopedToTenant = false;

    protected static ?string $model = User::class;
    protected static ?string $navigationIcon  = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Main';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Full Name')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->label('Email Address')
                ->email()
                ->required()
                ->unique(User::class, 'email', ignoreRecord: true), // ✅ Fixes the issue

            TextInput::make('password')
                ->label('Password')
                ->password()
                ->dehydrateStateUsing(fn($state) => bcrypt($state))
                ->required(fn(string $context) => $context === 'create')
                ->maxLength(255),

            DatePicker::make('date_of_birth')
                ->label('Date of Birth')
                ->nullable(),

            Select::make('companies')
                ->label('Company')
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
                    ->label('Full Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('companies.name')
                    ->label('Company')
                    ->sortable()
                    ->searchable()
                    ->badge(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                Impersonate::make(),
                Action::make('activities')
                    ->label('Activities')
                    ->icon('heroicon-o-newspaper')
                    ->iconPosition('before')
                    ->color('#C0C0C0')
                    ->url(fn($record) => UserResource::getUrl('activities', ['record' => $record])),
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
