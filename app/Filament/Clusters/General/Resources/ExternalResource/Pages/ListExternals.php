<?php

namespace App\Filament\Clusters\General\Resources\ExternalResource\Pages;

use App\Filament\Clusters\General\Resources\ExternalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExternals extends ListRecords
{
    protected static string $resource = ExternalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
