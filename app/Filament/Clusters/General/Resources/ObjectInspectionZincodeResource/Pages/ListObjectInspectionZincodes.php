<?php

namespace App\Filament\Clusters\General\Resources\ObjectInspectionZincodeResource\Pages;

use App\Filament\Clusters\General\Resources\ObjectInspectionZincodeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectInspectionZincodes extends ListRecords
{
    protected static string $resource = ObjectInspectionZincodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
