<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectBuildingTypesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectBuildingTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;


class ManageObjectBuildingTypes extends ManageRecords
{
    protected static string $resource = ObjectBuildingTypesResource::class;
    protected static ?string $title = 'Locaties - Gebouwtypes';

 

    protected function getHeaderActions(): array
    {
        return [
            \EightyNine\ExcelImport\ExcelImportAction::make()
            ->color("success")->label('Importeren')->modalHeading('Selecteer een excel bestand'),
    
            Actions\CreateAction::make()->modalWidth(MaxWidth::Large)->label('Toevoegen')->modalHeading('Toevoegen'),
 
        ];
    }
}
