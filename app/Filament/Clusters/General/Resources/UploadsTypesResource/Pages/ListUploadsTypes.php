<?php

namespace App\Filament\Clusters\General\Resources\UploadsTypesResource\Pages;

use App\Filament\Clusters\General\Resources\UploadsTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUploadsTypes extends ListRecords
{
    protected static string $resource = UploadsTypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
