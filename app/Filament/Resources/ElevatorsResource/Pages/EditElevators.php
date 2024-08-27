<?php

namespace App\Filament\Resources\ElevatorsResource\Pages;

use App\Filament\Resources\ElevatorsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditElevators extends EditRecord
{
    protected static string $resource = ElevatorsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
