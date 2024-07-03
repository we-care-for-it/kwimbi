<?php

namespace App\Filament\Resources\FleetManagementResource\Pages;

use App\Filament\Resources\FleetManagementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFleetManagement extends ListRecords
{
    protected static string $resource = FleetManagementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
