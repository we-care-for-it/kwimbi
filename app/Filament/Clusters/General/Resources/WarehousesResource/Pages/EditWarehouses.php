<?php

namespace App\Filament\Clusters\General\Resources\WarehousesResource\Pages;

use App\Filament\Clusters\General\Resources\WarehousesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWarehouses extends EditRecord
{
    protected static string $resource = WarehousesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
