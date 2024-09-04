<?php

namespace App\Filament\Resources\ObjectIncidentResource\Pages;

use App\Filament\Resources\ObjectIncidentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectIncidents extends ListRecords
{
    protected static string $resource = ObjectIncidentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
