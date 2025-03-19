<?php
namespace App\Filament\Resources\ObjectResource\Widgets;

use App\Models\ObjectMonitoring;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Model;

class MonitoringEventsTable extends BaseWidget
{
    protected int|string|array $columnSpan = '8';
    public ?Model $record                      = null;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ObjectMonitoring::where('category', 'error')
                    ->whereYear('created_at', date('Y'))
                    ->where('external_object_id', $this->record->monitoring_object_id)
            )
            ->columns([
                TextColumn::make("created_at")
                    ->label("Datum - Tijd")
                    ->date("h:i:s d-m-Y")
                    ->sortable()
                    ->toggleable(),
                TextColumn::make("error.description")
                    ->label("Omschrijving")
                    ->sortable()
                    ->toggleable(),
                TextColumn::make("error.posreason")
                    ->label("Reden")
                    ->sortable()
                    ->placeholder('-')
                    ->toggleable(),

            ])
            ->emptyState(view('partials.empty-state'));
    }

}
