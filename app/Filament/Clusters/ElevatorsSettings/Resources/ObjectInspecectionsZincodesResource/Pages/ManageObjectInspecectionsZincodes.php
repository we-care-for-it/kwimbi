<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectInspecectionsZincodesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectInspecectionsZincodesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageObjectInspecectionsZincodes extends ManageRecords
{
    protected static string $resource = ObjectInspecectionsZincodesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
