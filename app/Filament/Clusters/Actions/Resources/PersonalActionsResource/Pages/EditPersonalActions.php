<?php

namespace App\Filament\Clusters\Actions\Resources\PersonalActionsResource\Pages;

use App\Filament\Clusters\Actions\Resources\PersonalActionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPersonalActions extends EditRecord
{
    protected static string $resource = PersonalActionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
