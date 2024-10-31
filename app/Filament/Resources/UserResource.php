<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static bool $isScopedToTenant = false;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(components: [
                Section::make()
                    ->columns(12)
                    ->schema([
                        TextInput::make('first_name')
                            ->label(__('users.fields.first_name'))
                            ->columnSpan(5)
                            ->required(),
                        TextInput::make('infix')
                            ->label(__('users.fields.infix'))
                            ->columnSpan(2),
                        TextInput::make('last_name')
                            ->label(__('users.fields.last_name'))
                            ->columnSpan(5)
                            ->required(),

                            TextInput::make('password')
                            ->password()
                            ->revealable(),
                     
// Using Select Component
 Select::make('roles')
    ->relationship('roles', 'name')
    ->multiple()
    ->preload()
    ->searchable(),

                        TextInput::make('email')
                            ->label(__('users.fields.email'))
                            ->columnSpan(6)
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->required(),
                        DatePicker::make('date_of_birth')
                            ->label(__('users.fields.date_of_birth'))
                            ->columnSpan(6),
                    ]),
                Section::make(__('users.sections.private.title'))
                    ->description(__('users.sections.private.description'))
                    ->columns(12)
                    ->collapsed()
                    ->persistCollapsed()
                    ->schema([
                        TextInput::make('private_email')
                            ->label(__('users.sections.private.fields.private_email'))
                            ->columnSpan(6)
                            ->email(),
                        TextInput::make('private_phone')
                            ->label(__('users.sections.private.fields.private_phone'))
                            ->columnSpan(6),

                        TextInput::make('private_street')
                            ->label(__('users.sections.private.fields.private_street'))
                            ->columnSpan(6),
                        TextInput::make('private_house_number')
                            ->label(__('users.sections.private.fields.private_house_number'))
                            ->numeric()
                            ->columnSpan(3),
                        TextInput::make('private_house_number_addition')
                            ->label(__('users.sections.private.fields.private_house_number_addition'))
                            ->columnSpan(3),
                        TextInput::make('private_postal_code')
                            ->label(__('users.sections.private.fields.private_postal_code'))
                            ->columnSpan(4),
                        TextInput::make('private_city')
                            ->label(__('users.sections.private.fields.private_city'))
                            ->columnSpan(4),
                        TextInput::make('private_country')
                            ->label(__('users.sections.private.fields.private_country'))
                            ->columnSpan(4),


             

                    ]),
            ])
            ->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->modifyQueryUsing(fn (Builder $query) => $query
            //     ->whereHas('companies', fn ($query) => $query
            //         ->where('companies.id', Filament::getTenant()->id)
            //     )
            // )
            ->columns([
                TextColumn::make('name')
                    ->label(__('users.fields.name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label(__('users.fields.email'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('users.fields.created_at'))
                    ->since()
                    ->dateTooltip()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label(__('users.fields.updated_at'))
                    ->since()
                    ->dateTooltip()
                    ->searchable()
                    ->sortable(),
              

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('users.singular');
    }
}
