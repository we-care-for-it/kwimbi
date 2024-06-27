<?php

namespace App\Filament\Resources\InspectionCompaniesResource\Pages;

use App\Filament\Resources\InspectionCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInspectionCompanies extends EditRecord
{
    protected static string $resource = InspectionCompaniesResource::class;


    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }


    
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
