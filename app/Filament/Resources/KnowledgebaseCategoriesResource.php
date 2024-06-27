<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KnowledgebaseCategoriesResource\Pages;
use App\Filament\Resources\KnowledgebaseCategoriesResource\RelationManagers;
use App\Models\knowledgebaseCategorie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KnowledgebaseCategoriesResource extends Resource
{
    protected static ?string $model = knowledgebaseCategorie::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListKnowledgebaseCategories::route('/'),
            'create' => Pages\CreateKnowledgebaseCategories::route('/create'),
            'edit' => Pages\EditKnowledgebaseCategories::route('/{record}/edit'),
        ];
    }
}
