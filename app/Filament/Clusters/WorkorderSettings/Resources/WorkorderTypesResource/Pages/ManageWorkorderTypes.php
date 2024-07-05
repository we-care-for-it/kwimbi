<?php

namespace App\Filament\Clusters\WorkorderSettings\Resources\WorkorderTypesResource\Pages;

use App\Filament\Clusters\WorkorderSettings\Resources\WorkorderTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;

class ManageWorkorderTypes extends ManageRecords
{
    protected static string $resource = WorkorderTypesResource::class;
    protected static ?string $title = 'Werkopdrachten - Werkomschrijvingen';

    protected function getHeaderActions(): array
    {
        return [
            \EightyNine\ExcelImport\ExcelImportAction::make()
            ->color("success")->label('Importeren')->modalHeading('Selecteer een excel bestand'),
    
            Actions\CreateAction::make()->modalWidth(MaxWidth::ExtraLarge)->label('Toevoegen')->modalHeading('Toevoegen'),
        ];
    }
}
