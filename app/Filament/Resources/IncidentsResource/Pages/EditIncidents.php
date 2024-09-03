<?php

namespace App\Filament\Resources\IncidentsResource\Pages;

use App\Filament\Resources\IncidentsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIncidents extends EditRecord
{
    protected static string $resource = IncidentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
