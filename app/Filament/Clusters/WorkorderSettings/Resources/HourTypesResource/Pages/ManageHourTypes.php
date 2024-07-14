<?php

namespace App\Filament\Clusters\WorkorderSettings\Resources\HourTypesResource\Pages;

use App\Filament\Clusters\WorkorderSettings\Resources\HourTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;
class ManageHourTypes extends ManageRecords
{
    protected static string $resource = HourTypesResource::class;


  
    protected static ?string $title = 'Werkopdrachten - Uursoorten';
 

    protected function getHeaderActions(): array
    {
        return [
            \EightyNine\ExcelImport\ExcelImportAction::make()
            ->color("success")->label('Importeren')->modalHeading('Selecteer een excel bestand'),
    
            Actions\CreateAction::make()  ->modalHeading('Toevoegen')->label('Toevoegen')->modalWidth(MaxWidth::ExtraLarge),

        ];
    }
}
