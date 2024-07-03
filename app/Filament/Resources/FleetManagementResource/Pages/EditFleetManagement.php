<?php

namespace App\Filament\Resources\FleetManagementResource\Pages;

use App\Filament\Resources\FleetManagementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFleetManagement extends EditRecord
{
    protected static string $resource = FleetManagementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
