<?php

namespace App\Filament\Clusters\ToolsSettings\Resources\ToolsBrandsResource\Pages;

use App\Filament\Clusters\ToolsSettings\Resources\ToolsBrandsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;
class ManageToolsBrands extends ManageRecords
{
    protected static string $resource = ToolsBrandsResource::class;
    protected static ?string $title = 'Gereedschap - Merken';
    
    protected function getHeaderActions(): array
    {
        return [
            \EightyNine\ExcelImport\ExcelImportAction::make()
            ->color("success")->label('Importeren')->modalHeading('Selecteer een excel bestand'),
            Actions\CreateAction::make()->modalWidth(MaxWidth::ExtraLarge)->label('Toevoegen')->modalHeading('Toevoegen'),
        ];
    }
}
