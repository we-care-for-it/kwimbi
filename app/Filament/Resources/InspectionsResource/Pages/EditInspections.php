<?php

namespace App\Filament\Resources\InspectionsResource\Pages;

use App\Filament\Resources\InspectionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInspections extends EditRecord
{
    protected static string $resource = InspectionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
