<?php

namespace App\Filament\Clusters\General\Resources\UploadsTypesResource\Pages;

use App\Filament\Clusters\General\Resources\UploadsTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUploadsTypes extends EditRecord
{
    protected static string $resource = UploadsTypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
