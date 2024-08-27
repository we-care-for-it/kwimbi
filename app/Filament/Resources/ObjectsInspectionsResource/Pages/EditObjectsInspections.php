<?php

namespace App\Filament\Resources\ObjectsInspectionsResource\Pages;

use App\Filament\Resources\ObjectsInspectionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObjectsInspections extends EditRecord
{
    protected static string $resource = ObjectsInspectionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
