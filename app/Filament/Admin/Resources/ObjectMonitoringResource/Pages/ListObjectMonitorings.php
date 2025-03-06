<?php

namespace App\Filament\Admin\Resources\ObjectMonitoringResource\Pages;

use App\Filament\Admin\Resources\ObjectMonitoringResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectMonitorings extends ListRecords
{
    protected static string $resource = ObjectMonitoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
