<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ObjectTypeResource\Pages;
use App\Filament\Resources\ObjectTypeResource\RelationManagers;
use App\Models\ObjectType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ObjectTypeResource extends Resource
{
    protected static ?string $model                 = ObjectType::class;
    protected static ?string $navigationIcon        = 'heroicon-o-rectangle-stack';
    protected static bool $shouldRegisterNavigation = false;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                // Forms\Components\FileUpload::make('image')
                //     ->image()
                //     ->directory('object-types'),

                Forms\Components\Toggle::make('is_active')
                    ->default(true),

                Forms\Components\Fieldset::make('Opties')
                    ->schema([
                        Forms\Components\Toggle::make('has_inspections')
                            ->label('Keuringen'),
                        Forms\Components\Toggle::make('has_incidents')
                            ->label('Storingen'),
                        Forms\Components\Toggle::make('has_maintencycontracts')
                            ->label('Onderhoudscontracten'),
                        Forms\Components\Toggle::make('has_maintency')
                            ->label('Onderhoudsbeurten'),
                        Forms\Components\Toggle::make('has_tickets')
                            ->label('Tickets'),

                    ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->toggleable(),

                // Toggle columns for each relation
                Tables\Columns\ToggleColumn::make('has_inspections')
                    ->label('Inspections'),

                Tables\Columns\ToggleColumn::make('has_incidents')
                    ->label('Incidents'),

                Tables\Columns\ToggleColumn::make('has_maintencycontracts')
                    ->label('Maint. Contracts'),

                Tables\Columns\ToggleColumn::make('has_maintency')
                    ->label('Maintenance'),

                Tables\Columns\ToggleColumn::make('has_tickets')
                    ->label('Tickets'),

                Tables\Columns\ToggleColumn::make('show_on_resource_page')
                    ->label('Overzicht'),

            ])
            ->filters([
                Tables\Filters\Filter::make('is_active')
                    ->query(fn(Builder $query): Builder => $query->where('is_active', true))
                    ->label('Only active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Object Type Bewerken')
                    ->modalDescription('Pas het bestaande object type aan door de onderstaande gegevens zo volledig mogelijk in te vullen.')
                    ->tooltip('Bewerken')
                    ->label('')
                    ->modalIcon('heroicon-m-pencil-square')
                ,
                Tables\Actions\DeleteAction::make()
                    ->modalIcon('heroicon-o-trash')
                    ->tooltip('Verwijderen')
                    ->label('')
                    ->modalHeading('Verwijderen')
                    ->color('danger'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->emptyState(view('partials.empty-state'));

    }
    public static function getRelations(): array
    {
        return [
            RelationManagers\CustomFieldsRelationManager::class,

        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObjectTypes::route('/'),
            'view'  => Pages\ViewObjectType::route('/{record}'),
            'edit'  => Pages\EditObjectType::route('/{record}'),
        ];
    }
}
