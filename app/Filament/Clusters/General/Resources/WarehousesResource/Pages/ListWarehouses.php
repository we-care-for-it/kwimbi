<?php

namespace App\Filament\Clusters\General\Resources\WarehousesResource\Pages;

use App\Filament\Clusters\General\Resources\WarehousesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWarehouses extends ListRecords
{
    protected static string $resource = WarehousesResource::class;
    protected static ?string $title = 'Magazijnen';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Toevoegen'),
        ];
    }
}
