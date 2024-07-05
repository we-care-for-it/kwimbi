<?php
namespace App\Filament\Clusters\AssetsSettings\Resources;

use App\Filament\Clusters\AssetsSettings;
use App\Filament\Clusters\AssetsSettings\Resources\AssetsBrandsResource\Pages;
use App\Filament\Clusters\AssetsSettings\Resources\AssetsBrandsResource\RelationManagers;
use App\Models\assetBrand;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Layout;

//Form
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

//Table
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\FileUpload;

use Filament\Tables\Columns\ImageColumn;

class AssetsBrandsResource extends Resource
{
    protected static ? string $model = assetBrand::class;

    protected static ? string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ? string $navigationGroup = 'Basisgegevens';
    protected static ? string $navigationLabel = 'Merken';

    protected static ? string $cluster = AssetsSettings::class;

    public static function form(Form $form) : Form
    {
        return $form->schema([

        Forms\Components\TextInput::make('name')
            ->required()
            ->label('Naam')
            ->columnSpan('full') 
            
           
            ,

        Forms\Components\Toggle::make('is_active')
            ->label('Zichtbaar  ')
            ->default(true) 
    ,



        FileUpload::make('image')
            ->image()
            ->label('Afbeelding')

        , ]);

    }

    public static function table(Table $table) : Table
    {
        return $table->columns([ImageColumn::make('image')
            ->label('Logo')
            ->width(100) ,

            ToggleColumn::make('is_active')
            ->label('Zichbaar')
            ->onColor('success')
->offColor('danger')

            ->width(100)

        , TextColumn::make('name')
            ->label('Naam')
            ->searchable()  ->sortable() ,

        ])
            ->filters([Tables\Filters\TrashedFilter::make() , Filter::make('is_active')
            ->label('Toon alleen active merken')
            ->query(fn(Builder $query) : Builder => $query->where('is_active', true))

        ])
            ->actions([Tables\Actions\EditAction::make()
            ->modalHeading('Wijzigen') , Tables\Actions\DeleteAction::make()
            ->modalHeading('Verwijderen?') , ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()
            ->modalHeading('Verwijder geselecteerde rijen') ]) , ])
            ->emptyState(view('partials.empty-state'));;
    }

    public static function getPages() : array
    {
        return ['index' => Pages\ManageAssetsBrands::route('/') , ];
    }

}

