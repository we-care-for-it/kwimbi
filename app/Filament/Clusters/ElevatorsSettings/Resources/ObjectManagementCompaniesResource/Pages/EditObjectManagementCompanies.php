<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectManagementCompaniesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectManagementCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObjectManagementCompanies extends EditRecord
{
    protected static string $resource = ObjectManagementCompaniesResource::class;
    protected static ?string $title = 'Wijzig beheerder';
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
