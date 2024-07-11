<?php

namespace App\Filament\Clusters\ToolsSettings\Resources\ToolsTypesResource\Pages;

use App\Filament\Clusters\ToolsSettings\Resources\ToolsTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;

class ManageToolsTypes extends ManageRecords
{

    protected static ?string $title = 'Gereedschap - Types';

    protected static string $resource = ToolsTypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Toevoegen')->modalHeading('Type toevoegen')   ->modalWidth(MaxWidth::FiveExtraLarge),

        ];
    }
}
