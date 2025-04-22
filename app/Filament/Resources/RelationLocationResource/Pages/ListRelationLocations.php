<?php

namespace App\Filament\Resources\RelationLocationResource\Pages;

use App\Filament\Resources\RelationLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRelationLocations extends ListRecords
{
    protected static string $resource = RelationLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
