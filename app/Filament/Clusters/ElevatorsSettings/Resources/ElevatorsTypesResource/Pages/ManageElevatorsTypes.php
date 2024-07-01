<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ElevatorsTypesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ElevatorsTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageElevatorsTypes extends ManageRecords
{
    protected static string $resource = ElevatorsTypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
