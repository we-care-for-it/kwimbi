<?php

namespace App\Filament\Resources\ObjectsResource\Pages;

use App\Filament\Resources\ObjectsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObjects extends EditRecord
{
    protected static string $resource = ObjectsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
