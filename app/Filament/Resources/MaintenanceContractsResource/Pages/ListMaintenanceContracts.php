<?php

namespace App\Filament\Resources\MaintenanceContractsResource\Pages;

use App\Filament\Resources\MaintenanceContractsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaintenanceContracts extends ListRecords
{
    protected static string $resource = MaintenanceContractsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
