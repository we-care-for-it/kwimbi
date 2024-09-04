<?php

namespace App\Filament\Resources\BrandResource\RelationManagers;

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
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ModelsRelationManager extends RelationManager
{
    protected static string $relationship = 'models';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('asset_models.fields.name'))
                    ->required()
                    ->columnSpan(4)
                    ->maxLength(255),
                TextInput::make('price')
                    ->label(__('asset_models.fields.price'))
                    ->numeric()
                    ->inputMode('decimal')
                    ->step('0.01')
                    ->prefixIcon('heroicon-o-currency-euro')
                    ->columnSpan(3),
                Select::make('category_id')
                    ->relationship(name: 'category', titleAttribute: 'name')
                    ->preload()
                    ->searchable()
                    ->label(__('asset_models.fields.category'))
                    ->helperText(__('asset_models.fields.category_helper'))
                    ->live(onBlur: true)
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
                    ->columnSpan(5)
                    ->required(),
                ...CategoryResource::getMetadataForm(),
            ])->columns(12);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label(__('asset_models.fields.name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label(__('asset_models.fields.category'))
                    ->searchable()
                    ->sortable(),
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
