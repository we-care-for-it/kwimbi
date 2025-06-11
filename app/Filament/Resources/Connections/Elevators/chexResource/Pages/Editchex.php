<?php

namespace App\Filament\Resources\Connections\Elevators\chexResource\Pages;

use App\Filament\Resources\Connections\Elevators\chexResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class Editchex extends EditRecord
{
    protected static string $resource = chexResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
