<?php
namespace App\Filament\Resources;

use App\Filament\Resources\RelationTypeResource\Pages;
use App\Models\relationType;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RelationTypeResource extends Resource
{
    protected static ?string $model = relationType::class;

    protected static ?string $navigationIcon        = 'heroicon-o-rectangle-stack';
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationLabel       = "Oplossingen";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Section::make('Modules')
                    ->description('Een selectie van de modules voor deze relatie type')
                    ->schema([

                        ToggleButtons::make('options')
                            ->label('Opties')
                            ->multiple()
                            ->options([
                                'Medewerkers'     => 'Medewerkers',
                                'Contactpersonen' => 'Contactpersonen',
                                'Tickets'         => 'Tickets',
                                'Bijlages'        => 'Bijlages',
                                'Tijdregistratie' => 'Tijdregistratie',
                                'Projecten'       => 'Projecten',
                                'Locaties'        => 'Locaties',
                            ])
                            ->inline()
                            ->columns(2),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Actief')
                    ->width('100px')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([

                Tables\Actions\EditAction::make()
                    ->modalHeading('Relatie type')
                    ->modalDescription('Pas het bestaande object type aan door de onderstaande gegevens zo volledig mogelijk in te vullen.')
                    ->label('Bewerken')
                    ->modalIcon('heroicon-m-pencil-square')
                    ->slideOver(),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRelationTypes::route('/'),
            //  'create' => Pages\CreateRelationType::route('/create'),
            //  'edit'   => Pages\EditRelationType::route('/{record}/edit'),
        ];
    }
}
