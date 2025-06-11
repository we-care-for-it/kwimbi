<?php

namespace App\Filament\Resources\Connections\Elevators\modusystemResource\Pages;

use App\Filament\Resources\Connections\Elevators\modusystemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class Listmodusystems extends ListRecords
{
    protected static string $resource = modusystemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
