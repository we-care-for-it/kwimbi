<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocationResource\Pages\EditLocation;
use App\Filament\Resources\LocationResource\Pages\ListLocations;
use App\Models\Location;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LocationResource extends Resource
{
    protected static ?string $model                 = Location::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Naam')
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('postal_code')
                            ->label('Postcode')
                            ->maxLength(255),
                        TextInput::make('city')
                            ->label('Plaats')
                            ->maxLength(255),
                        TextInput::make('street')
                            ->label('Adres')
                            ->maxLength(255),
                    ])
                    ->columnSpan(['lg' => 2]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(100)
            ->paginated([25, 50, 100, 'all'])
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->weight('medium')
                    ->alignLeft()
                    ->label(__('locations.fields.name')),
                TextColumn::make('street')
                    ->searchable()
                    ->weight('medium')
                    ->label(__('locations.fields.address'))
                    ->alignLeft(),
                TextColumn::make('postal_code')
                    ->searchable()
                    ->weight('medium')
                    ->label(__('locations.fields.postal_code'))
                    ->alignLeft(),
                TextColumn::make('workplaces_count')
                    ->label(__('locations.fields.workplaces'))
                    ->counts('workplaces')
                    ->url(fn($record) => EditLocation::getUrl([
                        $record,
                        'activeRelationManager' => 'workplaces',
                    ]) . '#relationManagerWorkplaces')
                    ->alignCenter()
                    ->badge(),
                TextColumn::make('departments_count')
                    ->label(__('locations.fields.departments'))
                    ->counts('departments')
                    ->url(fn($record) => EditLocation::getUrl([
                        $record,
                        'activeRelationManager' => 'departments',
                    ]) . '#relationManagerDepartments')
                    ->alignCenter()
                    ->badge(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->modalHeading('Verwijderen van alle geselecteerde rijen'),
                ]),
            ])->emptyState(view("partials.empty-state"));
    }

    public static function getRelations(): array
    {
        return [
            // 'departments' => DepartmentsRelationManager::class,
            // 'workplaces'  => WorkplacesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLocations::route('/'),
            //    'create' => CreateLocation::route('/create'),
            'edit'  => EditLocation::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('locations.singular');
    }
}
