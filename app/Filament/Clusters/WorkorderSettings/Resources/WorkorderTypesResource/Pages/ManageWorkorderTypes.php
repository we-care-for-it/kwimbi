<?php

namespace App\Filament\Clusters\WorkorderSettings\Resources\WorkorderTypesResource\Pages;

use App\Filament\Clusters\WorkorderSettings\Resources\WorkorderTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageWorkorderTypes extends ManageRecords
{
    protected static string $resource = WorkorderTypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
