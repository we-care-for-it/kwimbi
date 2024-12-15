<?php

namespace App\Filament\Widgets;

use App\Models\Elevator;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Support\Enums\Alignment;
class StandStill extends BaseWidget
{
    protected static ?int $sort = 8;
    protected int | string | array $columnSpan = '12';
    protected static ?string $heading = 'Stilstaande liften';


    public function table(Table $table): Table
    {
        return $table
            ->query(
                Elevator::has('incident_stand_still')->latest()
            )
            ->columns([


     Tables\Columns\TextColumn::make("location")
                ->getStateUsing(function (Elevator $record): ?string {
                    if ($record?->location->name) {
                        return $record?->location->name;
                    } else {
                        return $record->location->address .
                            " - " .
                            $record->location->zipcode .
                            " " .
                            $record->location->place;
                    }
                })
                ->label("Locatie")
                ->description(function (Elevator $record) {
                    if (!$record?->location->name) {
                        return $record?->location->name;
                    } else {
                        return $record->location->address .
                            " - " .
                            $record->location->zipcode .
                            " " .
                            $record->location->place;
                    }
                }),
           
                Tables\Columns\TextColumn::make("incidents_count")
                ->toggleable()
                ->counts("incidents")
                ->label("Storingen")
                ->alignment(Alignment::Center)
                ->sortable()
                ->badge(),

                
                Tables\Columns\TextColumn::make("location.customer.name")

                ->label("Relatie")

  ,

  Tables\Columns\TextColumn::make("status_id")
  ->label("Status")
  ->badge()
,
Tables\Columns\TextColumn::make("type.name")
->label("Type")
 
->sortable()
->color('secondary')
 ,



           
                Tables\Columns\TextColumn::make("unit_no")
                    ->label("Unit nummer")
                    ->placeholder("Geen unitnummer")
            ]) ->recordUrl( function (Elevator $record) {
              return "admin/objects/".$record->id."?activeRelationManager=1";
            });
    }
}



