<?php

namespace App\Filament\Resources\ElevatorsResource\Pages;

use App\Filament\Resources\ElevatorsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListElevators extends ListRecords
{
    protected static string $resource = ElevatorsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
