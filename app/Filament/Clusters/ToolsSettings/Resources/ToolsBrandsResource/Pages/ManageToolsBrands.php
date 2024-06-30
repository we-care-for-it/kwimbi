<?php

namespace App\Filament\Clusters\ToolsSettings\Resources\ToolsBrandsResource\Pages;

use App\Filament\Clusters\ToolsSettings\Resources\ToolsBrandsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageToolsBrands extends ManageRecords
{
    protected static string $resource = ToolsBrandsResource::class;
    protected static ?string $title = 'Gereedschap - Merken';
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Toevoegen')->modalHeading('Toevoegen'),
        ];
    }
}
