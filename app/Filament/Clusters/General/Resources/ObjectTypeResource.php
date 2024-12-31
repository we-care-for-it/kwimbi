<?php

namespace App\Filament\Clusters\General\Resources;

use App\Filament\Clusters\General;
use App\Filament\Clusters\General\Resources\ObjectTypeResource\Pages;
use App\Filament\Clusters\General\Resources\ObjectTypeResource\RelationManagers;
use App\Models\ObjectType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ObjectTypeResource extends Resource
{
    protected static ?string $model = ObjectType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
     protected static ?string $cluster = General::class;
    protected static ?string $navigationGroup = "Basisgegevens";
    protected static ?string $navigationLabel = "kjh";
  


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('name')
            ->label('Omschrijving')
            ->columnSpan('full')  ->required(),

            Forms\Components\Toggle::make('is_active')
            ->label('Zichtbaar  ')
            ->default(true)
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ToggleColumn::make('is_active')
                            ->label('Zichbaar')
                            ->onColor('success')
                            ->offColor('danger')            
                            ->width(100),
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
            'index' => Pages\ListObjectTypes::route('/'),
            // 'create' => Pages\CreateObjectType::route('/create'),
            // 'edit' => Pages\EditObjectType::route('/{record}/edit'),
        ];
    }
}
