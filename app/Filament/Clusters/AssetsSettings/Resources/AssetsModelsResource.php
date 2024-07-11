<?php

namespace App\Filament\Clusters\AssetsSettings\Resources;

use App\Filament\Clusters\AssetsSettings;
use App\Filament\Clusters\AssetsSettings\Resources\AssetsModelsResource\Pages;
use App\Filament\Clusters\AssetsSettings\Resources\AssetsModelsResource\RelationManagers;
use App\Models\assetModel;
use App\Models\assetBrand;
use App\Models\assetCategorie;





use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;

//Form
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
//Table
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;

use Filament\Support\Enums\MaxWidth;




class AssetsModelsResource extends Resource
{
    protected static ?string $model = assetModel::class;

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
                ->columnSpan('full') 
                ->required(),



                Select::make('brand_id')
->label('Merk')
                
->relationship(name: 'brand', titleAttribute: 'name')
->loadingMessage('Merken laden...')
->createOptionForm([

    Forms\Components\TextInput::make('name')
        ->required(),

])   ->required(),




Select::make('category_id')
->label('Categorie')
                
->relationship(name: 'category', titleAttribute: 'name')
->loadingMessage('Categorieen laden...')
->createOptionForm([

    Forms\Components\TextInput::make('name')
        ->required(),

])   ->required(),
             
           
]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                
          


                TextColumn::make('brand.name')
                ->label('Merk')->sortable(),
                

                TextColumn::make('name')
                ->label('Naam')->sortable()->searchable(),
                
                TextColumn::make('category.name') 
                ->label('Categorie')->sortable()
                 
            ])
            ->filters([
                 

                SelectFilter::make('brand_id')
    ->label('Merk')       
    ->options(assetBrand::all()->pluck('name', 'id')),

 
    SelectFilter::make('category_id')
    ->label('Categorie ')       
    ->options(assetCategorie::all()->pluck('name', 'id')),

 
])
            ->actions([
                Tables\Actions\EditAction::make()->modalWidth(MaxWidth::Medium),
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
