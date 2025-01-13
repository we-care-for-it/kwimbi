<?php

namespace App\Filament\Clusters\Actions\Resources\AllActionsResource\Pages;

use App\Filament\Clusters\Actions\Resources\AllActionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAllActions extends ListRecords
{
    protected static string $resource = AllActionsResource::class;

    protected static ?string $title = 'Alle acties';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
