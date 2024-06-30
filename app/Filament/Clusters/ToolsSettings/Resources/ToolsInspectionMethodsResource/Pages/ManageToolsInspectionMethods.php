<?php

namespace App\Filament\Clusters\ToolsSettings\Resources\ToolsInspectionMethodsResource\Pages;

use App\Filament\Clusters\ToolsSettings\Resources\ToolsInspectionMethodsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageToolsInspectionMethods extends ManageRecords
{
    protected static ?string $title = 'Gereedschap - Keuringsmethodes';

    protected static string $resource = ToolsInspectionMethodsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Toevoegen'),
        ];
    }
}
