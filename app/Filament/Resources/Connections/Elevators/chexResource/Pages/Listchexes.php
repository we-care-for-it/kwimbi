<?php

namespace App\Filament\Resources\Connections\Elevators\chexResource\Pages;

use App\Filament\Resources\Connections\Elevators\chexResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class Listchexes extends ListRecords
{
    protected static string $resource = chexResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
