<?php

namespace App\Filament\Clusters\General\Resources\GpsObjectResource\Pages;

use App\Filament\Clusters\General\Resources\GpsObjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGpsObject extends EditRecord
{
    protected static string $resource = GpsObjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
