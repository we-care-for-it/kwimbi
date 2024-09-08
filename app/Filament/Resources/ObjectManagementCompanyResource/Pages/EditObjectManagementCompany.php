<?php

namespace App\Filament\Resources\ObjectManagementCompanyResource\Pages;

use App\Filament\Resources\ObjectManagementCompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObjectManagementCompany extends EditRecord
{
    protected static string $resource = ObjectManagementCompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
