<?php
namespace App\Filament\Resources;

use App\Filament\Resources\WorkorderActivitieResource\Pages;
use App\Models\workType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WorkorderActivitieResource extends Resource
{
    protected static ?string $model = workType::class;

    protected static ?string $navigationIcon        = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel       = "Type werkzaamheden";
    protected static ?string $title                 = "Type werkzaamheden";
    protected static ?string $pluralModelLabel      = 'Type werkzaamheden';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Naam')
                    ->required()
                    ->columnSpan('full')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')
                    ->label('Actief')
                    ->default(true),
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
                //
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
                    ->color('danger')])
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkorderActivities::route('/'),
            // 'create' => Pages\CreateWorkorderActivitie::route('/create'),
            //  'edit'   => Pages\EditWorkorderActivitie::route('/{record}/edit'),
        ];
    }
}
