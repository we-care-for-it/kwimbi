<?php
namespace App\Filament\Resources\ObjectResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends BaseWidget
{

    public ?Model $record                     = null;
    protected static ?string $pollingInterval = '10s';
    protected function getColumns(): int
    {
        return 4;
    }
    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        //arrow-path

        return [
            Stat::make('Versie:' . $this->record?->getMonitoringVersion?->value, ucfirst($this->record?->getMonitoringType?->value) ?? 'Onbekend type')
                ->descriptionIcon('heroicon-m-link'),

            // Stat::make('Objectstatus', $this->record?->getMonitoringState?->value)
            //     ->description("Ge-update: " . ucfirst($this->record?->getMonitoringType?->created_at)),

            Stat::make('Actuele verdieping', $this->record?->getMonitoringFloor?->value, ""),

            Stat::make('Verbindingstatus', $this->record?->getMonitoringStateText()),
            ///   ->color($this->record?->getMonitoringStateColor()),

        ];
    }

    // protected function getDescription(): ?string
    // {
    //     if ($this->record?->getMonitoringLastInsert) {
    //         return "Laatste update op: " . date_format($this->record?->getMonitoringLastInsert?->created_at, "d-m-Y") . " om " . date_format($this->record->getMonitoringLastInsert->created_at, "H:i:s");
    //     } else {
    //         return 'onbekend';
    //     }
    // }

}
