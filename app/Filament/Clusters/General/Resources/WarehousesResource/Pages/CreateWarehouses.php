<?php

namespace App\Filament\Clusters\General\Resources\WarehousesResource\Pages;

use App\Filament\Clusters\General\Resources\WarehousesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;




class CreateWarehouses extends CreateRecord
{
    protected static ?string $title = 'Magazijn toevoegen';
    protected static string $resource = WarehousesResource::class;


    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}

}

