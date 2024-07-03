<?php

namespace App\Filament\Resources\ObjectsResource\Pages;

use App\Filament\Resources\ObjectsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjects extends ListRecords
{
    protected static string $resource = ObjectsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
