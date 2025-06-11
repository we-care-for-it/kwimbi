<?php
namespace App\Filament\Resources\RelationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use LaraZeus\Tiles\Tables\Columns\TileColumn;

class EmployeesRelationManager extends RelationManager
{
    protected static string $relationship = 'employees';

    protected static ?string $title = 'Medewerkers';

    protected static ?string $modelLabel = 'medewerker';

    protected static ?string $pluralModelLabel = 'medewerkers';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return $ownerRecord->employees()->count();
    }

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {

        return in_array('Medewerkers', $ownerRecord?->type?->options) ? true : false;
    }

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
                    ->email()
                    ->maxLength(255),

                Forms\Components\Select::make('department_id')
                    ->label('Afdeling')
                    ->options(fn() => $this->ownerRecord?->departments?->pluck('name', 'id') ?? [])
                    ->searchable()
                    ->placeholder('Selecteer een afdeling'),

                Forms\Components\TextInput::make('function')
                    ->label('Functie')
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone_number')
                    ->label('Telefoonnummer')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')

            ->filters([
                TrashedFilter::make(),
            ])

            ->columns([
                TileColumn::make('name')
                    ->description(fn($record) => $record->function)
                    ->sortable()
                    ->searchable()
                    ->image(fn($record) => $record->avatar)
                    ->label('Naam'),

                TextColumn::make('email')
                    ->placeholder('-')
                    ->searchable()
                    ->url(fn($record) => "mailto:{$record->email}")
                    ->label('E-mailadres'),

                TextColumn::make('department.name')
                    ->label('Afdeling')
                    ->placeholder(''),

                TextColumn::make('function')
                    ->placeholder('-')
                    ->searchable()
                    ->sortable()
                    ->label('Functie'),

                TextColumn::make('phone_number')
                    ->placeholder('-')
                    ->searchable()
                    ->url(fn($record) => "tel:{$record->contact?->phone_number}")
                    ->label('Telefoonnummer')
                    ->description(fn($record): ?string => $record?->mobile_number ?? null),
            ])
            ->emptyState(view('partials.empty-state'))

            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalWidth(MaxWidth::FourExtraLarge)
                    ->modalHeading('Medewerker toevoegen')
                    ->modalDescription('Voeg een nieuwe medewerker toe door de onderstaande gegevens zo volledig mogelijk in te vullen.')
                    ->icon('heroicon-m-plus')
                    ->modalIcon('heroicon-o-plus')
                    ->link()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['type_id'] = 1;
                        return $data;
                    })
                    ->label('Medewerker toevoegen'),

            ])

            ->actions([

                Tables\Actions\ViewAction::make('openContact')
                    ->label('Bekijk')

                    ->icon('heroicon-s-eye'),

                Tables\Actions\ActionGroup::make([

                    Tables\Actions\EditAction::make()
                        ->label('Wijzigen')

                        ->modalHeading('COntact wijzigen'),

                    Tables\Actions\DeleteAction::make()
                        ->label('Verwijder'),
                ])

                ,

            ])
        ;
    }
}
