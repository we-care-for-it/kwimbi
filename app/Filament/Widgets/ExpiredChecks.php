<?php
namespace App\Filament\Widgets;

use App\Models\Elevator;
use Carbon\Carbon;
use DB;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ExpiredChecks extends BaseWidget
{
    protected static ?int $sort                = 2;
    protected static ?string $heading          = "Verlopen keuringen";
    protected int|string|array $columnSpan = '12';
    protected static bool $isLazy              = false;
    protected static ?string $maxHeight        = '600px';

    public function table(Table $table): Table
    {

        return $table
            ->query(
                Elevator::query()
                    ->whereHas('latestInspection', fn($subQuery) => $subQuery
                            ->where('end_date', '<', Carbon::today())
                            ->whereColumn('id', DB::raw('(SELECT id FROM object_inspections WHERE object_inspections.elevator_id = elevators.id and deleted_at is null ORDER BY end_date DESC LIMIT 1)'))
                    )
            )
            ->columns([

                Tables\Columns\TextColumn::make("elevator.nobo_no")
                    ->label("NOBO Nr")
                    ->placeholder("Geen NOBO Nummer"),

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
                        if (! $record?->location->name) {
                            return $record?->location->name;
                        } else {
                            return $record->location->address .
                            " - " .
                            $record->location->zipcode .
                            " " .
                            $record->location->place;
                        }
                    }),

                Tables\Columns\TextColumn::make("latestInspection.status_id")
                    ->label("Status")->badge()
                ,

                Tables\Columns\TextColumn::make("latestInspection.end_date")
                    ->label("Verlopen op")
                    ->dateTime("d-m-Y"),

                Tables\Columns\TextColumn::make("name")
                    ->label("Naam")
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make("location.customer.name")
                    ->label("Relatie")->Url(function (object $record) {
                    return "/admin/customers/" . $record->customer_id . "";
                })
                    ->icon("heroicon-c-link")
                    ->placeholder("Niet opgegeven"),

            ])->emptyState(view("partials.empty-state"))
            ->recordUrl(function (Elevator $record) {
                return "admin/objects/" .
                $record->id;
            })
            ->paginated(false);

    }

}
