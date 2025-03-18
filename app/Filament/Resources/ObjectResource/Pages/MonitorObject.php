<?php
namespace App\Filament\Resources\ObjectResource\Pages;

use App\Filament\Resources\ObjectResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class MonitorObject extends Page
{
    protected static string $resource = ObjectResource::class;

    protected static string $view = 'filament.resources.object-resource.pages.monitor-object';

    use InteractsWithRecord;

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ObjectResource\Widgets\Monitoring::class,
            ObjectResource\Widgets\FloorChart::class,
            ObjectResource\Widgets\IncidentChart::class,
        ];

    }

    public function getSubheading(): ?string
    {

        if ($this->getRecord()->location) {

            $location_name = null;
            if ($this->getRecord()->location?->name) {
                $location_name = " | " . $this->getRecord()->location?->name;
            }
            return $this->getRecord()->location->address . " " . $this->getRecord()->location->zipcode . " " . $this->getRecord()->location->place . $location_name;

        } else {
            return "";
        }

    }

}
