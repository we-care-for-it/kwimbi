<?php

namespace App\Filament\Resources\MaintenancesResource\Pages;

use App\Filament\Resources\MaintenancesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaintenances extends ListRecords
{
    protected static string $resource = MaintenancesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
