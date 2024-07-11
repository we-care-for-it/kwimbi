<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ToolsResource\Pages;
use App\Filament\Resources\ToolsResource\RelationManagers;
use App\Models\Tools;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


//Form
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

//Table
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;



class ToolsResource extends Resource
{
    protected static ?string $model = Tools::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

            
    protected static ? string $navigationGroup = 'Beheer';
    protected static ? string $navigationLabel = 'Gereedsschappen';
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
                TextColumn::make('name')->searchable()
            ->label('Naam')
           
            ->searchable()
            ->sortable()
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
            'index' => Pages\ListTools::route('/'),
            'create' => Pages\CreateTools::route('/create'),
            'edit' => Pages\EditTools::route('/{record}/edit'),
        ];
    }
}
