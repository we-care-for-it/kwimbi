<?php
namespace App\Filament\Resources\ObjectResource\Widgets;

use Filament\Support\Enums\IconPosition;
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
            Stat::make('Versie', $this->record->getMonitoringVersion->value)
                ->descriptionIcon('heroicon-m-link', IconPosition::Before)
                ->description("Type: " . ucfirst($this->record->getMonitoringType->value) ?? 'Onbekend type'),

            Stat::make('Objectstatus', $this->record->getMonitoringState->value)
                ->description("Update: " . ucfirst($this->record->getMonitoringType->created_at)),

            Stat::make('Actuele verdieping', $this->record->getMonitoringFloor->value)
                ->description("Update : " . date_format($this->record->getMonitoringFloor->created_at, "d-m-Y") . " om " . date_format($this->record->getMonitoringFloor->created_at, "H:i:s")),

            Stat::make('Verbindingstatus', $this->record->getMonitoringConnectState()),
            //      ->description("Update : " . date_format($this->record->getMonitoringState->created_at, "d-m-Y") . " om " . date_format($this->record->getMonitoringFloor->getMonitoringState, "H:i:s")),

        ];
    }

    protected function getDescription(): ?string
    {
        return "Laatste update op: " . date_format($this->record->getMonitoringLastInsert->created_at, "d-m-Y") . " om " . date_format($this->record->getMonitoringLastInsert->created_at, "H:i:s");
    }

}
