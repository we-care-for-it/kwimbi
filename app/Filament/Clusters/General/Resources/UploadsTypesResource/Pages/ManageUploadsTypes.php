<?php

namespace App\Filament\Clusters\General\Resources\UploadsTypesResource\Pages;

use App\Filament\Clusters\General\Resources\UploadsTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageUploadsTypes extends ManageRecords
{
    protected static string $resource = UploadsTypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
