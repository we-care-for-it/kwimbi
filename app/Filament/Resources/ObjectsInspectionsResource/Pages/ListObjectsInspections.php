<?php

namespace App\Filament\Resources\ObjectsInspectionsResource\Pages;

use App\Filament\Resources\ObjectsInspectionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectsInspections extends ListRecords
{
    protected static string $resource = ObjectsInspectionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
