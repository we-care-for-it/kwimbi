<?php

namespace App\Filament\Resources\InspectionCompaniesResource\Pages;

use App\Filament\Resources\InspectionCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInspectionCompanies extends CreateRecord
{

    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }

    protected static string $resource = InspectionCompaniesResource::class;

   


}
