<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ModelResource\Pages;
use App\Models\Brand;
use App\Models\ObjectModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ModelResource extends Resource
{
    protected static ?string $model = ObjectModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel  = "Object Modellen";
    protected static ?string $title            = "Object Modellen";
    protected static ?string $pluralModelLabel = "Object Modellen";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('name')
                    ->label('Naam')
                    ->required()
                    ->columnSpan("full")
                    ->maxLength(255),

                Forms\Components\Select::make("brand_id")
                    ->label("Merk")
                    ->required()
                    ->searchable()()
                    ->options(
                        Brand::pluck("name", "id")
                    ),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')
                    ->label('Naam')
                    ->searchable(),

                TextColumn::make('location.name')
                    ->label('Locatie')
                    ->placeholder("-")
                    ->searchable(),

            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Magazijn Bewerken')
                    ->modalDescription('Pas de bestaande magazijn aan door de onderstaande gegevens zo volledig mogelijk in te vullen.')
                    ->tooltip('Bewerken')
                    ->label('')
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
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
            ->emptyState(view('partials.empty-state'));
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListModels::route('/'),
            //  'create' => Pages\CreateModel::route('/create'),
            // 'edit'   => Pages\EditModel::route('/{record}/edit'),
        ];
    }

}
