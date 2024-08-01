<?php

namespace App\Filament\Resources\ObjectsLocationsResource\Pages;

use App\Filament\Resources\ObjectsLocationsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectsLocations extends ListRecords
{
    protected static string $resource = ObjectsLocationsResource::class;
    protected static ?string $title = 'Locatie - Overzicht';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Toevoegen'),
        ];
    }
}
