<?php
namespace App\Filament\Resources\ObjectResource\Widgets;

use App\Models\ObjectMonitoring;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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
                    ->orderBy('date_time', 'desc')
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
                    ->getStateUsing(function ($record): ?string {
                        if ($record?->category == 'error') {
                            return $record?->error->description;
                        } else {
                            return "";
                        }
                    })
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

                TextColumn::make("value")
                    ->label("Waarde")
                    ->sortable()
                    ->placeholder('-')
                    ->toggleable(),

                TextColumn::make("param01")
                    ->label("Verdieping")
                    ->sortable()
                    ->placeholder('-')
                    ->toggleable(),

            ])

            ->filters([
                SelectFilter::make('category')
                    ->label('Type')
                    ->options(ObjectMonitoring::where('external_object_id', $this->record->monitoring_object_id)->pluck('category', 'category')),

            ])

            ->emptyState(view('partials.empty-state'))
        ;
    }

}
