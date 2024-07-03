<?php

namespace App\Filament\Resources\ObjectsLocationsResource\Pages;

use App\Filament\Resources\ObjectsLocationsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObjectsLocations extends EditRecord
{
    protected static string $resource = ObjectsLocationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
