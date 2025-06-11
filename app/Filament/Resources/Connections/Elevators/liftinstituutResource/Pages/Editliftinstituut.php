<?php

namespace App\Filament\Resources\Connections\Elevators\liftinstituutResource\Pages;

use App\Filament\Resources\Connections\Elevators\liftinstituutResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class Editliftinstituut extends EditRecord
{
    protected static string $resource = liftinstituutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
