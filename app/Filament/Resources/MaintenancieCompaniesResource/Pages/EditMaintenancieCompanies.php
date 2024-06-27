<?php

namespace App\Filament\Resources\MaintenancieCompaniesResource\Pages;

use App\Filament\Resources\MaintenancieCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMaintenancieCompanies extends EditRecord
{
    protected static string $resource = MaintenancieCompaniesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
