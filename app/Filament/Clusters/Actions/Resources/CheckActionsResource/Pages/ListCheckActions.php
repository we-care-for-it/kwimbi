<?php

namespace App\Filament\Clusters\Actions\Resources\CheckActionsResource\Pages;

use App\Filament\Clusters\Actions\Resources\CheckActionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCheckActions extends ListRecords
{
    protected static string $resource = CheckActionsResource::class;
    protected static ?string $title = 'Keuringspunten acties';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
