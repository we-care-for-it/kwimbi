<?php
namespace App\Filament\Resources\ObjectResource\Widgets;

use App\Models\ObjectMonitoring;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Model;

class MonitoringIncidentTable extends BaseWidget
{
    protected int|string|array $columnSpan = '8';
    public ?Model $record                      = null;
    protected static ?string $heading          = "Laatste foutmeldingen";

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ObjectMonitoring::whereYear('date_time', date('Y'))
                    ->where('external_object_id', $this->record->monitoring_object_id)
                    ->where('category', 'error')
                    ->orderBy('date_time', 'desc')
            )
            ->columns([
                TextColumn::make("date_time")
                    ->label("Datum - Tijd")
                    ->date("d-m-Y h:i:s")
                    ->sortable()
                    ->width('100')
                    ->toggleable(),
                TextColumn::make("error.description")
                    ->label("Omschrijving")
                    ->sortable()
                    ->toggleable()

                ,

                TextColumn::make("error.posreason")
                    ->label("Reden")
                    ->sortable()
                    ->placeholder('-')
                    ->toggleable(),

            ])
            ->emptyState(view('partials.empty-state'));
    }

}
