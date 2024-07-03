<?php

namespace App\Filament\Resources\ObjectsLocationsResource\Pages;

use App\Filament\Resources\ObjectsLocationsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectsLocations extends ListRecords
{
    protected static string $resource = ObjectsLocationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
