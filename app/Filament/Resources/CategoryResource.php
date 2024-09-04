<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers\SubCategoriesRelationManager;
use App\Models\AssetCategory;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = AssetCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('asset_categories.fields.name'))
                    ->required(),
                ...self::getMetadataForm(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('asset_categories.fields.name'))
                    ->searchable()
                    ->sortable(),
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
            SubCategoriesRelationManager::make(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('asset_categories.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('asset_categories.plural');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('assets.plural');
    }

    public static function getMetadataForm(): array
    {
        return [
            Repeater::make('metadata')
                ->label(__('asset_categories.fields.metadata.label'))
                ->columnSpan(12)
                ->reorderable(false)
                ->itemLabel(fn (array $state): ?string => $state['key'] ?? null)
                ->defaultItems(0)
                ->default(function ($livewire) {
                    if (property_exists($livewire, 'ownerRecord')) {
                        return $livewire->ownerRecord->metadata;
                    }

                    return [];
                })
                ->collapsed()
                ->live()
                ->schema([
                    TextInput::make('key')
                        ->label(__('asset_categories.fields.metadata.key'))
                        ->required(),
                    Select::make('type')
                        ->label(__('asset_categories.fields.metadata.type.label'))
                        ->options([
                            'text' => __('asset_categories.fields.metadata.type.options.text'),
                            'number' => __('asset_categories.fields.metadata.type.options.number'),
                            'date' => __('asset_categories.fields.metadata.type.options.date'),
                        ])
                        ->required(),
                    TextInput::make('value')
                        ->label(__('asset_categories.fields.metadata.value'))
                        ->hidden(fn (callable $get) => $get('type') !== 'text'),
                    TextInput::make('value')
                        ->label(__('asset_categories.fields.metadata.value'))
                        ->numeric()
                        ->nullable()
                        ->hidden(fn (callable $get) => $get('type') !== 'number'),
                    DatePicker::make('value')
                        ->label(__('asset_categories.fields.metadata.value'))
                        ->date()
                        ->nullable()
                        ->hidden(fn (callable $get) => $get('type') !== 'date'),
                ]),
        ];
    }
}
