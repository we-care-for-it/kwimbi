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

}
