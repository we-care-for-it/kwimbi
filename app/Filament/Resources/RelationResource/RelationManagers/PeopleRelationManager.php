<?php

namespace App\Filament\Resources\RelationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use App\Models\Contact;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Models\Brand;
use App\Models\Employee;
use App\Models\ObjectModel;
use App\Models\ObjectType;
use App\Models\relationLocation;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
 
use Filament\Tables\Columns\TextColumn;

 
use Illuminate\Database\Eloquent\Model;
use LaraZeus\Tiles\Tables\Columns\TileColumn;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Grouping\Group;
use App\Filament\Exports\ObjectsExporter;
use Filament\Tables\Actions\ExportAction;
use Filament\Actions\Exports\Models\Export;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\SelectFilter;


class PeopleRelationManager extends RelationManager
{
    protected static string $relationship = 'people';
        protected static ?string $title = 'Personen';
    protected static ?string $modelLabel = 'Personen';
    protected static ?string $pluralModelLabel = 'Personen';

 
    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return $ownerRecord->people()   ->where('type_id', 1)      ->where('relation_id', $ownerRecord->id)->count();
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type_id')
                    ->label('Categorie / Type')
                    ->options([
                        1 => 'Medewerkers',
                        2 => 'Contactpersonen',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('first_name')
                    ->label('Voornaam')
                    ->required(),

                Forms\Components\TextInput::make('last_name')
                    ->label('Achternaam')
                    ->required(),

                Forms\Components\TextInput::make('email')
                    ->label('E-mailadres')
                    ->email(),

                Forms\Components\TextInput::make('department')
                    ->label('Afdeling'),

                Forms\Components\TextInput::make('function')
                    ->label('Functie'),

                Forms\Components\TextInput::make('phone_number')
                    ->label('Telefoonnummer')
                    ->tel()
                    ->regex('/^\+?\d{6,20}$/'),

                Forms\Components\Select::make('location_id')
                    ->label('Locatie')
                    ->options(fn() => relationLocation::pluck('address', 'id')),

                Forms\Components\Toggle::make('show_in_contactlist')
                    ->label('Toon in contactpersonen overzicht'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table

            ->defaultGroup('type_id')
          ->groups([
   
                            Group::make('type_id')
                               ->titlePrefixedWithLabel(true)
                                ->getTitleFromRecordUsing(fn($record): string => match($record->type_id) {
            1 => 'Medewerker',
            2 => 'Contactpersoon',
            default => 'Onbekend',
        })
                ->label('Categorie')
              
                  ,

 

        ])   




           // ->groupBy(fn($record) => $record->type_id == 1 ? 'Medewerkers' : 'Contactpersonen')
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

                TextColumn::make('department')
                    ->label('Afdeling')
                    ->placeholder('-'),

                TextColumn::make('function')
                    ->placeholder('-')
                    ->searchable()
                    ->sortable()
                    ->label('Functie'),

                TextColumn::make('phone_number')
                    ->placeholder('-')
                    ->searchable()
                    ->url(fn($record) => "tel:{$record?->phone_number}")
                    ->label('Telefoonnummer')
                    ->description(fn($record): ?string => $record?->mobile_number ?? null),

                TextColumn::make('type_id')
                    ->label('Categorie')
                    ->getStateUsing(fn($record) => $record->type_id == 1 ? 'Medewerker' : 'Contactpersoon')
                    ->badge(fn($record) => $record->type_id == 1 ? 'success' : 'primary')
                    ->sortable(),
            ])
            ->filters([
                  TrashedFilter::make(),
                // SelectFilter::make('department')
                //     ->label('Afdeling')
                //     ->options(fn() => Contact::select('department')->distinct()->pluck('department')),
                SelectFilter::make('type_id')
                    ->label('Categorie')
                    ->options([
                        1 => 'Medewerkers',
                        2 => 'Contactpersonen',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                   ->slideOver(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->slideOver(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
