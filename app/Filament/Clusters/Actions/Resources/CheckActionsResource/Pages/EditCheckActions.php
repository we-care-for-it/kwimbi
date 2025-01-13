<?php

namespace App\Filament\Clusters\Actions\Resources\CheckActionsResource\Pages;

use App\Filament\Clusters\Actions\Resources\CheckActionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCheckActions extends EditRecord
{
    protected static string $resource = CheckActionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
