<?php

namespace App\Filament\Resources\ObjectsLocationsResource\Pages;

use App\Filament\Resources\ObjectsLocationsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObjectsLocations extends EditRecord
{
    protected static string $resource = ObjectsLocationsResource::class;
    protected static ?string $title = 'Locatie - Bewerken';
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
