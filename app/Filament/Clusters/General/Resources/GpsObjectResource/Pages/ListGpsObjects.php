<?php

namespace App\Filament\Clusters\General\Resources\GpsObjectResource\Pages;

use App\Filament\Clusters\General\Resources\GpsObjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGpsObjects extends ListRecords
{
    protected static string $resource = GpsObjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
