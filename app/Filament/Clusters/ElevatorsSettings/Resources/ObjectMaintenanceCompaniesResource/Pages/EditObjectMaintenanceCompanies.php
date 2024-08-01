<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectMaintenanceCompaniesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectMaintenanceCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObjectMaintenanceCompanies extends EditRecord
{
    protected static string $resource = ObjectMaintenanceCompaniesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
