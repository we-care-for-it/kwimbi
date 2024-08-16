<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectManagementCompaniesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectManagementCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewObjectManagementCompanies extends ViewRecord
{
    protected static string $resource = ObjectManagementCompaniesResource::class;
    protected static ?string $title = 'Toon beheerder';
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->label('Wijzigen'),
        ];
    }
}
