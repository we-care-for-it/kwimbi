<?php

namespace App\Filament\Resources\ManagementCompaniesResource\Pages;

use App\Filament\Resources\ManagementCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManagementCompanies extends ListRecords
{
    protected static string $resource = ManagementCompaniesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
