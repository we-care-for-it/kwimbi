<?php

namespace App\Filament\Resources\ObjectsManagemenCompaniesResource\Pages;

use App\Filament\Resources\ObjectsManagemenCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObjectsManagemenCompanies extends EditRecord
{
    protected static string $resource = ObjectsManagemenCompaniesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
