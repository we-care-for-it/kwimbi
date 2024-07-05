<?php

namespace App\Filament\Clusters\AssetsSettings\Resources;

use App\Filament\Clusters\AssetsSettings;
use App\Filament\Clusters\AssetsSettings\Resources\AssetsModelsResource\Pages;
use App\Filament\Clusters\AssetsSettings\Resources\AssetsModelsResource\RelationManagers;
use App\Models\AssetModel;
use App\Models\assetBrand;
use App\Models\assetCategorie;





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
use Filament\Forms\Components\Select;
//Table
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;





class AssetsModelsResource extends Resource
{
    protected static ?string $model = AssetModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ? string $navigationGroup = 'Basisgegevens';
    protected static ? string $navigationLabel = 'Modellen';
    protected static ?string $cluster = AssetsSettings::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
             
            Forms\Components\TextInput::make('name')
            ->label('Naam')
            ->columnSpan('full') ,

           
 
Select::make('brand_id')
    ->label('Merk')
    ->options(assetBrand::all()->pluck('name', 'id'))
    ->searchable(),
    Select::make('category_id')
    ->label('Categorie')
    ->options(assetCategorie::all()->pluck('name', 'id'))
    ->searchable()

]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                
                ImageColumn::make('brand.image')->label('Logo')  
                ->width(100),




                TextColumn::make('brand.name')
                ->label('Merk')->sortable(),
                

                TextColumn::make('name')
                ->label('Naam')->sortable(),
                
                TextColumn::make('category.name') 
                ->label('Categorie')->sortable()
                 
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAssetsModels::route('/'),
        ];
    }
}
