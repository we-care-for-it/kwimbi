<?php

namespace App\Filament\Resources\ObjectsManagemenCompaniesResource\Pages;

use App\Filament\Resources\ObjectsManagemenCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectsManagemenCompanies extends ListRecords
{
    protected static string $resource = ObjectsManagemenCompaniesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
