<?php

namespace App\Filament\App\Resources\ObjectResource\Pages;

use App\Filament\App\Resources\ObjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObject extends EditRecord
{
    protected static string $resource = ObjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
