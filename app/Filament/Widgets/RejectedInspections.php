<?php

namespace App\Filament\Widgets;

use App\Models\Elevator;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Support\Enums\Alignment;
class RejectedInspections extends BaseWidget
{
 
    protected static ?int $sort = 3;
    protected static ?string $heading = "Afgekeurde objecten";
    protected ?string $description = 'An overview of some analytics.';
    protected int | string | array $columnSpan = '6';
    public function table(Table $table): Table
    {
        return $table
            ->query(Elevator::has("latestinspections")->limit(10))
            
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

                Tables\Columns\TextColumn::make("location.customer.name")
                ->label("Relatie"),

                Tables\Columns\TextColumn::make("inspection.status_id")
                    ->label("Status")
                    ,
                Tables\Columns\TextColumn::make("type.name")
                    ->label("Type")
                    ->sortable()
                    ->badge()
                    ->color("primary"),
                Tables\Columns\TextColumn::make("unit_no")
                    ->label("Unit nummer")
                    ->placeholder("Geen unitnummer"),
            ])
            ->recordUrl(function (Elevator $record) {
                return "admin/objects/" .
                    $record->id .
                    "?activeRelationManager=1";
            })
            ->paginated(false);
    }
}
