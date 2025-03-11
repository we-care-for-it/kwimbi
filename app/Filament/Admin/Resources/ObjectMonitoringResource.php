<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ObjectMonitoringResource\Pages;
use App\Filament\Admin\Resources\ObjectMonitoringResource\RelationManagers;
use App\Models\ObjectMonitoring;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ObjectMonitoringResource extends Resource
{
    protected static ?string $model = ObjectMonitoring::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sensor01')
                    ->label('Sensor01')
                    ->sortable(),
                TextColumn::make('sensor02')
                    ->label('Sensor02')
                    ->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable(),
            
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
            'index' => Pages\ListObjectMonitorings::route('/'),
            'create' => Pages\CreateObjectMonitoring::route('/create'),
            'edit' => Pages\EditObjectMonitoring::route('/{record}/edit'),
        ];
    }
}
