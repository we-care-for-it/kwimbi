<?php

namespace App\Filament\Resources\MaintenanceContractsResource\Pages;

use App\Filament\Resources\MaintenanceContractsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMaintenanceContracts extends EditRecord
{
    protected static string $resource = MaintenanceContractsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
