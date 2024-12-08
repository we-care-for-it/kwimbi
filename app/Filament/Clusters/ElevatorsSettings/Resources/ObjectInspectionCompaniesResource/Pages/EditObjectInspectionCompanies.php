<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectInspectionCompaniesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectInspectionCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObjectInspectionCompanies extends EditRecord
{
    protected static string $resource = ObjectInspectionCompaniesResource::class;
    protected static ?string $title = 'Object - Keuringsinstanties wijzigen';
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }


    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
}
