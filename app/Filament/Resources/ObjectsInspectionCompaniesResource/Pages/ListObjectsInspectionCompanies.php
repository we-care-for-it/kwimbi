<?php

namespace App\Filament\Resources\ObjectsInspectionCompaniesResource\Pages;

use App\Filament\Resources\ObjectsInspectionCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectsInspectionCompanies extends ListRecords
{
    protected static string $resource = ObjectsInspectionCompaniesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
