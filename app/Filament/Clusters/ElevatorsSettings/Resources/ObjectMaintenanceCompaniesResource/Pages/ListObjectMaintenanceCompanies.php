<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectMaintenanceCompaniesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectMaintenanceCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectMaintenanceCompanies extends ListRecords
{
    protected static string $resource = ObjectMaintenanceCompaniesResource::class;
    protected static ?string $title = 'Object - Onderhoudspartijen';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Toevoegen'),
        ];
    }
}
