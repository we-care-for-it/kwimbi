<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectMaintenanceCompaniesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectMaintenanceCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateObjectMaintenanceCompanies extends CreateRecord
{
    protected static string $resource = ObjectMaintenanceCompaniesResource::class;
    protected static ?string $title = 'Onderhoudspartij toevoegen';
  

    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }


}
