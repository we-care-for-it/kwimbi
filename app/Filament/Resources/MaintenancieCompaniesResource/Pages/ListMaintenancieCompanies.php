<?php

namespace App\Filament\Resources\MaintenancieCompaniesResource\Pages;

use App\Filament\Resources\MaintenancieCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaintenancieCompanies extends ListRecords
{
    protected static string $resource = MaintenancieCompaniesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
