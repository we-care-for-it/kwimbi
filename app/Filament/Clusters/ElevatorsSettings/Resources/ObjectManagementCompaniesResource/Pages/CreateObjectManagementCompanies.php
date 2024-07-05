<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectManagementCompaniesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectManagementCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateObjectManagementCompanies extends CreateRecord
{

    protected static ?string $title = 'Beheerder toevoegen';
    
    protected static string $resource = ObjectManagementCompaniesResource::class;
}
