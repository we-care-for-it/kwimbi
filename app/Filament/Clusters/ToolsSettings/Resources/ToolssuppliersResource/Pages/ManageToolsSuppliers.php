<?php

namespace App\Filament\Clusters\ToolsSettings\Resources\ToolsSuppliersResource\Pages;

use App\Filament\Clusters\ToolsSettings\Resources\ToolsSuppliersResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageToolsSuppliers extends ManageRecords
{
    protected static string $resource = ToolsSuppliersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
