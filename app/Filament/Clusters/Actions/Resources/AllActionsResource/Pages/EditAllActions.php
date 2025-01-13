<?php

namespace App\Filament\Clusters\Actions\Resources\AllActionsResource\Pages;

use App\Filament\Clusters\Actions\Resources\AllActionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAllActions extends EditRecord
{
    protected static string $resource = AllActionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
