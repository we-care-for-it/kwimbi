<?php

namespace App\Filament\Resources\ObjectInspectionCompanyResource\Pages;

use App\Filament\Resources\ObjectInspectionCompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectInspectionCompanies extends ListRecords
{
    protected static string $resource = ObjectInspectionCompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
