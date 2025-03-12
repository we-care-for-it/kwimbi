<?php

namespace App\Filament\Resources\BrandResource\RelationManagers;

use App\Filament\Resources\AssetResource\Pages\ListAssets;
use App\Filament\Resources\CategoryResource;
use App\Models\AssetCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ModelsRelationManager extends RelationManager
{
    protected static string $relationship = 'models';

    public function form(Form $form): Form
    {
        $categories = AssetCategory::query()
            ->where(fn ($query) => $query
                ->whereNotNull('parent_id')
                ->orWhereDoesntHave('subCategories')
            )
            ->get()
            ->groupBy('parent_id')
            ->mapWithKeys(function ($categories, $parent_id) {
                $categorie = $categories->first()->parent ?? $categories->first();

                return [
                    $categorie->name => $categories->pluck('name', 'id'),
                ];
            });

        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('asset_models.fields.name'))
                    ->required()
                    ->maxLength(255)
                    ->required()
                    ->columnSpan(4),
                Select::make('category_id')
                    ->options($categories)
                    ->preload()
                    ->searchable()
                    ->label('Categorie')
                    ->required()
                    ->columnSpan(4),
                Select::make('brand_id')
                    ->relationship(name: 'brand', titleAttribute: 'name')
                    ->preload()
                    ->searchable()
                    ->label('Merk')
                    ->required()
                    ->columnSpan(4),
                TextInput::make('price')
                    ->label(__('asset_models.fields.price'))
                    ->numeric()
                    ->placeholder('-')
                    ->inputMode('decimal')
                    ->step('0.01')
                    ->prefixIcon('heroicon-o-currency-euro')
                    ->columnSpan(4),
                ...CategoryResource::getMetadataForm(),
            ])->columns(12);
    }

    public function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(100)
            ->paginated([25, 50, 100, 'all'])
            ->recordTitleAttribute('name')
            ->groups([
                Group::make('category.name')
                    ->label('Subcategorie'),
                Group::make('category.parent.name')
                    ->label('Hoofdcategorie'),
            ])->defaultGroup('category.parent.name')
            ->columns([
                TextColumn::make('index')
                    ->label('#')
                    ->rowIndex(),
                TextColumn::make('name')
                    ->label(__('asset_models.fields.name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Prijs')
                    ->searchable()
                    ->placeholder('-')
                    ->sortable(),
                TextColumn::make('category.parent.name')
                    ->label('Hoofdcategorie')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Subcategorie')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('asset_count')
                    ->label('Aantal assets')
                    ->badge()
                    ->url(fn ($record) => ListAssets::getUrl([
                        'tableFilters[model_id][value]' => $record->id,
                    ]))
                    ->sortable()
                    ->getStateUsing(fn (Model $record) => $record->assets()->where('model_id', $record->id)->count()),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('asset_models.plural');
    }

    protected static function getModelLabel(): ?string
    {
        return __('asset_models.singular');
    }
}
