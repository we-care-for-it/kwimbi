<?php

namespace App\Filament\Resources\ObjectResource\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Database\Eloquent\Model;
use App\Models\Elevator;

class FloorTable extends BaseWidget
{
    public ?Model $record                      = null;
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Trend::where('external_object_id', $this->record->monitoring_object_id)->whereYear('created_at', date('Y'))

                ->dateColumn('created_at')
                ->between(
                    start: now()->startOfYear(),
                    end: now()->endOfYear(),
                )
                ->perMonth()
                ->count()
            )
            ->columns([
                Tables\Columns\TextColumn::make('floor')
                    ->label('Position')
                    ->sortable(),
                Tables\Columns\TextColumn::make('Stops')
                    ->label('Stops')
                    ->sortable(),
                Tables\Columns\TextColumn::make('Open')
                    ->label('Open')
                    ->sortable(),
                Tables\Columns\TextColumn::make('Close')
                    ->label('Close')
                    ->sortable(),            
                ]);
    }
}
