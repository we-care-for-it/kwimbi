<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectInspectionCompaniesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectInspectionCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateObjectInspectionCompanies extends CreateRecord
{

    protected static ?string $title = 'Keuringsinstanties toevoegen';
    protected static string $resource = ObjectInspectionCompaniesResource::class;

    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }

    
}
