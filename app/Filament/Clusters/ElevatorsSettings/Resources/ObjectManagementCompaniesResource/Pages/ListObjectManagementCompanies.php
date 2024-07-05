<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectManagementCompaniesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectManagementCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectManagementCompanies extends ListRecords
{
    protected static string $resource = ObjectManagementCompaniesResource::class;
    protected static ?string $title = 'Object - Beheerders';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Toevoegen'),
        ];
    }
}
