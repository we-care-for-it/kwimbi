<?php

namespace App\Filament\Resources\VehicleGPSResource\Pages;

use App\Filament\Resources\VehicleGPSResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicleGPS extends ListRecords
{
    protected static string $resource = VehicleGPSResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
