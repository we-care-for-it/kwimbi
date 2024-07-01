<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaintenancesResource\Pages;
use App\Filament\Resources\MaintenancesResource\RelationManagers;
use App\Models\Maintenance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaintenancesResource extends Resource
{

    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $model = Maintenance::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('plan_date'),
                Forms\Components\TextInput::make('status_id')
                    ->numeric(),
                Forms\Components\DatePicker::make('execution_date'),
                Forms\Components\Textarea::make('remark')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('attachment')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('elevator_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('plan_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('execution_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('elevator_id')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListMaintenances::route('/'),
            'create' => Pages\CreateMaintenances::route('/create'),
            'edit' => Pages\EditMaintenances::route('/{record}/edit'),
        ];
    }
}
