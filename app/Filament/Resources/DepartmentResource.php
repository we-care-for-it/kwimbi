<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages\CreateDepartment;
use App\Filament\Resources\DepartmentResource\Pages\EditDepartment;
use App\Filament\Resources\DepartmentResource\Pages\ListDepartments;
use App\Filament\Resources\DepartmentResource\RelationManagers\UserRelationManager;
use App\Filament\Resources\DepartmentResource\RelationManagers\WorkplacesRelationManager;
use App\Models\Department;
use App\Rules\NoOverlapRange;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make([
                    'default' => 2,
                ])
                    ->schema([
                        TextInput::make('name')
                            ->label(__('departments.fields.name'))
                            ->required()
                            ->maxLength(255),
                        Select::make('location_id')
                            ->relationship(name: 'location', titleAttribute: 'street')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Location'),
                        TextInput::make('3cx_range_from')
                            ->label('3cx range start')
                            ->numeric()
                            ->rules([
                                fn (Get $get, ?Department $record): NoOverlapRange => new NoOverlapRange($record, $get('3cx_range_from'), $get('3cx_range_to')),
                            ]),
                        TextInput::make('3cx_range_to')
                            ->label('3cx range einde')
                            ->numeric()
                            ->gte('3cx_range_from'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->recordTitleAttribute('name')
            ->defaultPaginationPageOption(100)
            ->paginated([25, 50, 100, 'all'])
            ->columns([
                TextColumn::make('index')
                    ->label('#')
                    ->rowIndex(),
                TextColumn::make('name')
                    ->label(__('departments.fields.name')),
                TextColumn::make('workplaces_count')
                    ->label('Werkplekken')
                    ->counts('workplaces')
                    ->alignCenter()
                    ->badge(),
                TextColumn::make('users_count')
                    ->label('Medewerkers')
                    ->counts('users')
                    ->alignCenter()
                    ->badge(),
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

    public static function getRelations(): array
    {
        return [
            WorkplacesRelationManager::make(),
            UserRelationManager::make(),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Afdelingen';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Afdelingen';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDepartments::route('/'),
            'create' => CreateDepartment::route('/create'),
            'edit' => EditDepartment::route('/{record}/edit'),
        ];
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('departments.plural');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('users.nav_group');
    }
}
