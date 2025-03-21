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
    protected static ?string $heading          = "Alle meldingen";
    public function table(Table $table): Table
    {
        return $table
            ->query(
                ObjectMonitoring::whereYear('date_time', date('Y'))
                    ->where('external_object_id', $this->record->monitoring_object_id)
                    ->orderBy('id')
            )
            ->columns([

                TextColumn::make("id")
                    ->label("#")
                    ->sortable()
                    ->placeholder('-')
                    ->toggleable(),
                TextColumn::make("date_time")
                    ->label("Datum - Tijd")
                    ->date("d-m-Y h:i:s")
                    ->width('100')
                    ->sortable()
                    ->placeholder('-')
                    ->toggleable(),
                TextColumn::make("error.description")
                    ->label("Omschrijving")
                    ->sortable()
                    ->placeholder('-')
                    ->toggleable(),

                TextColumn::make("category")
                    ->label("Categorie")
                    ->sortable()
                    ->placeholder('-')
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
