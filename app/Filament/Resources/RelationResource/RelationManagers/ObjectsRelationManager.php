<?php
namespace App\Filament\Resources\RelationResource\RelationManagers;

use App\Models\Contact;
use App\Models\contactType;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use LaraZeus\Tiles\Tables\Columns\TileColumn;

class ObjectsRelationManager extends RelationManager
{
    protected static bool $isScopedToTenant = false;
    protected static string $relationship   = 'contacts';
    protected static ?string $icon          = 'heroicon-o-user';
    protected static ?string $title         = 'Objecten';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        // $ownerModel is of actual type Job
        return $ownerRecord->contacts->count();
    }
    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {

        return in_array('Objecten', $ownerRecord?->type->options) ? true : false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->label('Voornaam')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('last_name')
                            ->label('Achternaam')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('company')
                            ->label('Bedrijf')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('E-mailadres')
                            ->email()
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

                        Forms\Components\Select::make('type_id')
                            ->label('Categorie')
                            ->options(contactType::where('is_active', 1)->pluck("name", "id")),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TileColumn::make('name')
                    ->description(fn($record) => $record->function)
                    ->sortable()
                    ->image(fn($record) => $record->avatar),

                TextColumn::make("company")
                    ->label("Bedrijf")
                    ->placeholder("-")
                    ->toggleable()
                    ->sortable()
                    ->searchable(),

                TextColumn::make("type.name")
                    ->label("Categorie")
                    ->placeholder("-")
                    ->badge()
                    ->color('primary')
                    ->toggleable()
                    ->sortable(),

                TextColumn::make('email')
                    ->placeholder('-')
                    ->Url(function (object $record) {
                        return "mailto:" . $record?->email;
                    })
                    ->label('Emailadres')
                    ->toggleable()
                    ->sortable(),

                TextColumn::make('department')
                    ->placeholder('-')
                    ->label('Afdeling')
                    ->toggleable()
                    ->sortable(),

                TextColumn::make('function')
                    ->placeholder('-')
                    ->toggleable()
                    ->sortable()
                    ->label('Functie'),

                TextColumn::make('phone_number')
                    ->placeholder('-')
                    ->Url(function (object $record) {
                        return "tel:" . $record?->contact?->phone_number;
                    })
                    ->label('Telefoonnummers')
                    ->description(fn($record): ?string => $record?->mobile_number ?? null),
            ])
            ->emptyState(view('partials.empty-state-small'))
            ->recordUrl(function ($record) {
                return "/contacts/" . $record->id;
            })
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make('createContact')
                    ->label('Contacpersoon toevoegen')
                    ->icon('heroicon-m-plus')
                    ->modalIcon('heroicon-o-plus')
                    ->modalHeading('Contactpersoon tovoegen')
                    ->slideOver(),
            ])
            ->actions([
                Action::make('openContact')
                    ->label('Bekijk contact')
                    ->color('primary')
                    ->url(function ($record) {
                        return "/contacts/" . $record->id;
                    })->icon('heroicon-s-eye'),

                EditAction::make()
                    ->slideOver()
                    ->label('Bewerken'),
            ])
            ->bulkActions([
                //
            ]);
    }
}
