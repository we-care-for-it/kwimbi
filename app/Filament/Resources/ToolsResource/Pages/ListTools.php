<?php

namespace App\Filament\Resources\ToolsResource\Pages;

use App\Filament\Resources\ToolsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTools extends ListRecords
{
    protected static string $resource = ToolsResource::class;
    protected static ?string $title = 'Gereedschap - Overzicht';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
