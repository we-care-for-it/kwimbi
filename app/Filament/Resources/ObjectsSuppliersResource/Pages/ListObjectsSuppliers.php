<?php

namespace App\Filament\Resources\ObjectsSuppliersResource\Pages;

use App\Filament\Resources\ObjectsSuppliersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectsSuppliers extends ListRecords
{
    protected static string $resource = ObjectsSuppliersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
