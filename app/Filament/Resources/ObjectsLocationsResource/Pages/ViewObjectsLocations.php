<?php

namespace App\Filament\Resources\ObjectsLocationsResource\Pages;

use App\Filament\Resources\ObjectsLocationsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewObjectsLocations extends ViewRecord
{
    protected static string $resource = ObjectsLocationsResource::class;
    protected static ?string $title = 'Locatie - Bekijken';
}
