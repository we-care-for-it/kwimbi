<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetResource\Pages;
use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\AssetModel;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('model_id')
                    ->relationship(name: 'model', titleAttribute: 'name')
                    ->preload()
                    ->searchable()
                    ->label(__('assets.fields.model'))
                    ->helperText(__('assets.fields.model_helper'))
                    ->live(onBlur: true)
                    ->columnSpan(6)
                    ->afterStateUpdated(function (?string $state, ?string $old, callable $set, callable $get) {
                        $model = AssetModel::find($state);
                        if (! $model) {
                            return;
                        }

                        $set('price', $model->price);
                        $set('category_id', null);

                        if (! empty($get('metadata'))) {
                            return;
                        }

                        $set('metadata', $model->metadata);
                    })
                    ->required()
                    ->hidden(fn (callable $get) => $get('category_id') !== null),
                Select::make('category_id')
                    ->relationship(name: 'category', titleAttribute: 'name')
                    ->preload()
                    ->searchable()
                    ->label(__('assets.fields.category'))
                    ->helperText(__('assets.fields.category_helper'))
                    ->live(onBlur: true)
                    ->columnSpan(6)
                    ->afterStateUpdated(function (?string $state, ?string $old, callable $set, callable $get) {
                        $category = AssetCategory::find($state);
                        if (! $category) {
                            return;
                        }

                        $set('category_id', null);

                        if (! empty($get('metadata'))) {
                            return;
                        }

                        $set('metadata', $category->metadata);
                    })
                    ->required()
                    ->hidden(fn (callable $get) => $get('model_id') !== null),

                TextInput::make('serial_number')
                    ->label(__('assets.fields.serial_number'))
                    ->columnSpan(6),
                TextInput::make('price')
                    ->label(__('asset_models.fields.price'))
                    ->numeric()
                    ->inputMode('decimal')
                    ->step('0.01')
                    ->prefixIcon('heroicon-o-currency-euro')
                    ->columnSpan(3),

                Select::make('location_id')
                    ->relationship(name: 'location', titleAttribute: 'name')
                    ->preload()
                    ->searchable()
                    ->label(__('assets.fields.location'))
                    ->columnSpan(6),
                Select::make('supplier_id')
                    ->relationship(name: 'supplier', titleAttribute: 'name')
                    ->preload()
                    ->searchable()
                    ->label(__('assets.fields.supplier'))
                    ->columnSpan(6),
                ...CategoryResource::getMetadataForm(),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('assets.fields.name'))
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListAssets::route('/'),
            'create' => Pages\CreateAsset::route('/create'),
            'edit' => Pages\EditAsset::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('assets.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('assets.plural');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('assets.plural');
    }
}
