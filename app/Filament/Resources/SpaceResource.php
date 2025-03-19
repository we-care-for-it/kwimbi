<?php
namespace App\Filament\Resources;

use App\Filament\Resources\SpaceResource\Pages;
use App\Filament\Resources\SpaceResource\RelationManagers;
use App\Models\Space;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SpaceResource extends Resource
{
    protected static ?string $model = Space::class;

    protected static ?string $navigationIcon        = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup       = 'Objecten';
    protected static ?int $navigationSort           = 7;
    protected static ?string $navigationLabel       = "Ruimtes";
    protected static ?string $title                 = "Ruimtes";
    protected static ?string $pluralModelLabel      = 'Ruimtes';
    protected static bool $shouldRegisterNavigation = false;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Algemene informatie')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Naam')
                                    ->columnSpan('full')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                    ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Tabs::make('Ruimte Informatie')
                    ->columnSpan('full')
                    ->tabs([
                        Tabs\Tab::make('Algemene informatie')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextEntry::make('name')->label('Naam')->placeholder('-'),
                            ])->columns(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Naam')
                    ->searchable(),

            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Bewerken')
                    ->tooltip('Bewerken')
                    ->label('Bewerken')
                    ->modalIcon('heroicon-o-pencil')
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
            ])
            ->emptyState(view('partials.empty-state'));
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\LocationRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSpaces::route('/'),
            'view'  => Pages\ViewSpace::route('/{record}'),
            // 'create' => Pages\CreateSpace::route('/create'),
            // 'edit' => Pages\EditSpace::route('/{record}/edit'),
        ];
    }
}
