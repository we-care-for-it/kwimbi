<?php
namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages\CreateBrand;
use App\Filament\Resources\BrandResource\Pages\EditBrand;
use App\Filament\Resources\BrandResource\Pages\ListBrands;
use App\Filament\Resources\BrandResource\RelationManagers\ModelsRelationManager;
use App\Models\assetBrand;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BrandResource extends Resource
{
    protected static ?string $model                 = assetBrand::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('asset_brands.fields.name'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(100)
            ->paginated([25, 50, 100, 'all'])
            ->columns([
                TextColumn::make('index')
                    ->label('#')
                    ->rowIndex(),
                TextColumn::make('name')
                    ->label(__('asset_brands.fields.name'))
                    ->searchable()
                    ->placeholder('-')
                    ->sortable(),
                TextColumn::make('models_count')
                    ->label('Modellen')
                    ->counts('models')
                    ->url(fn($record) => EditBrand::getUrl([
                        $record,
                        'activeRelationManager' => 'models',
                    ]) . '#relationManagerModels')
                    ->alignCenter()
                    ->badge(),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            'models' => ModelsRelationManager::make(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListBrands::route('/'),
            'create' => CreateBrand::route('/create'),
            'edit'   => EditBrand::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('asset_brands.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('asset_brands.plural');
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Hardwarebeheer';
    }
}
