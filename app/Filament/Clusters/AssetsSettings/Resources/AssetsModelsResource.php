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


//Form
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
//Table
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;

use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\FileUpload;



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
            ->columnSpan('full')      ->required(),  

           
 

            Select::make('brand_id')
            ->label('Merk')
          
            ->loadingMessage('Merken laden...')
            ->relationship(name: 'brand', titleAttribute: 'name')
           // ->searchable()
            ->createOptionForm([
                Forms\Components\TextInput::make('name')
                    ->required(),
         
            ]),
            


Select::make('category_id')
->label('Categorie')
            
->relationship(name: 'category', titleAttribute: 'name')
->loadingMessage('Categorieën laden...')
->createOptionForm([
Forms\Components\TextInput::make('name')
    ->required(),

]),


    FileUpload::make('image')
    ->image()
    ->label('Afbeelding')

,

]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                
                ImageColumn::make('image')->label('Afbeelding')  
                ->width(100),




                TextColumn::make('brand.name')
                ->label('Merk')->sortable(),
                

                TextColumn::make('name')
                ->label('Naam')->sortable()->searchable(),
                
                TextColumn::make('category.name') 
                ->label('Categorie')->sortable(),

                
                 
            ])
            ->filters([
                 

                SelectFilter::make('brand_id')
    ->label('Merk')       
    ->options(assetBrand::all()->pluck('name', 'id')),



SelectFilter::make('category_id')->label('Categorie')
->options(assetCategorie::all()->pluck('name', 'id'))
            ])
            ->actions([
                Tables\Actions\EditAction::make()->modalHeading('Wijzigen')->modalWidth(MaxWidth::FiveExtraLarge),
                Tables\Actions\DeleteAction::make()->modalHeading('Verwijderen van alle geselecteerde rijen'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
         //           Tables\Actions\DeleteBulkAction::make()->modalHeading(''),
                ]),
            ])      
             ->emptyState(view('partials.empty-state')) ;
            ;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAssetsModels::route('/'),
        ];
    }
}
