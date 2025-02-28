<?php
namespace App\Filament\Widgets;

use App\Enums\InspectionStatus;
use App\Models\Elevator;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Facades\Filament;
class RejectedInspections extends BaseWidget
{
    protected static ?int $sort                = 80;
    protected static ?string $heading          = "Afgekeurde objecten";
    protected int|string|array $columnSpan = '6';
    protected static bool $isLazy              = false;
    protected static ?string $maxHeight        = '600px';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Elevator::where('company_id', Filament::getTenant()->id)->where('current_inspection_status_id', InspectionStatus::REJECTED)->limit(10)
            )
            ->columns([

                // Tables\Columns\TextColumn::make("elevator.nobo_no")
                //     ->label("NOBO Nr")
                //     ->placeholder("Geen NOBO Nummer"),

                Tables\Columns\TextColumn::make("location")
                    ->getStateUsing(function (Elevator $record): ?string {
                        if ($record?->location?->name) {
                            return $record?->location?->name;
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
                        if (! $record?->location?->name) {
                            return $record?->location?->name;
                        } else {
                            return $record->location->address .
                            " - " .
                            $record->location->zipcode .
                            " " .
                            $record->location->place;
                        }
                    }),

                // Tables\Columns\TextColumn::make("latestInspection.status_id")
                //     ->label("Status")
                //     ->sortable()
                //     ->badge()
                // ,

                Tables\Columns\TextColumn::make("latestInspection.end_date")
                    ->label("Verlopen op")
                    ->dateTime("d-m-Y"),

                // Tables\Columns\TextColumn::make("name")
                //     ->label("Naam")
                //     ->sortable()
                //     ->placeholder('-'),

                Tables\Columns\TextColumn::make("location.customer.name")
                    ->label("Relatie")->Url(function (object $record) {
                    return "/admin/customers/" . $record->customer_id . "";
                })
                    ->icon("heroicon-c-link")
                    ->placeholder("Niet opgegeven"),

            ])->emptyState(view("partials.empty-state"))
            ->recordUrl(function (Elevator $record) {
                return "/" . Filament::getTenant()->id . "/objects/" . $record->id . "?activeRelationManager=1";;
       
            })
            ->paginated(false);

    }

}
