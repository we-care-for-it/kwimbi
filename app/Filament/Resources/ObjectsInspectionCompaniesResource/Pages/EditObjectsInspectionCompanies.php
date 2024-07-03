<?php

namespace App\Filament\Resources\ObjectsInspectionCompaniesResource\Pages;

use App\Filament\Resources\ObjectsInspectionCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObjectsInspectionCompanies extends EditRecord
{
    protected static string $resource = ObjectsInspectionCompaniesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
