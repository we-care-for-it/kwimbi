<?php
namespace App\Filament\Resources;

use App\Filament\Imports\ObjectTypeImporter;
use App\Filament\Resources\ObjectTypeResource\Pages;
use App\Models\ObjectType;
use Filament\Forms;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ObjectTypeResource extends Resource
{
    protected static ?string $model                 = ObjectType::class;
    protected static ?string $navigationIcon        = 'heroicon-o-rectangle-stack';
    protected static bool $shouldRegisterNavigation = false;
    public static function form(Form $form): Form
    {
        return $form

            ->schema([

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->columnSpan('full')
                    ->maxLength(255),

                ToggleButtons::make('options')
                    ->label('Opties')
                    ->multiple()
                    ->options([
                        'Keuringen'            => 'Keuringen',
                        'Onderhoudscontracten' => 'Onderhoudscontracten',
                        'Tickets'              => 'Tickets',
                        'Onderhoudsbeurten'    => 'Onderhoudsbeurten',

                    ])
                    ->required()
                    ->inline()
                    ->columns(2),

                ToggleButtons::make('visibility')
                    ->label('Koppelbaar aan')
                    ->multiple()
                    ->options([
                        'Medewerker' => 'Medewerker',
                        'Locatie'    => 'Locatie',
                        'Werkplek'   => 'Werkplek',
                        'Afdeling'   => 'Afdeling',
                    ])
                    ->required()
                    ->inline(),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ImportAction::make()
                    ->importer(ObjectTypeImporter::class)
                    ->label('Importeren'),
            ])
            ->columns([

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Actief')

                    ->width('100px'),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()

                    ->sortable(),

                Tables\Columns\TextColumn::make('options')
                    ->label('Opties')
                    ->badge(),

                Tables\Columns\TextColumn::make('visibility')
                    ->label('Zichtbaarheid')
                    ->placeholder('-')

                    ->badge(),

            ])
            ->filters([
                Tables\Filters\Filter::make('is_active')
                    ->query(fn(Builder $query): Builder => $query->where('is_active', true))
                    ->label('Only active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Object Type Bewerken')
                    ->modalDescription('Pas het bestaande object type aan door de onderstaande gegevens zo volledig mogelijk in te vullen.')
                    ->tooltip('Bewerken')
                    ->label('Bewerken')

                ,
                Tables\Actions\DeleteAction::make()
                    ->modalIcon('heroicon-o-trash')
                    ->tooltip('Verwijderen')
                    ->label('')
                    ->modalHeading('Verwijderen')
                    ->color('danger'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->emptyState(view('partials.empty-state'));

    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObjectTypes::route('/'),
            //    'view'  => Pages\ViewObjectType::route('/{record}'),
            //  'edit'  => Pages\EditObjectType::route('/{record}'),
        ];
    }
}
