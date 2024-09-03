<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectBuildingTypesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectBuildingTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;
use Filament\Actions\Action;

class ManageObjectBuildingTypes extends ManageRecords
{
    protected static string $resource = ObjectBuildingTypesResource::class;
    protected static ?string $title = 'Locaties - Gebouwtypes';

 

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
            ->url(route('filament.admin.resources.elevators.index'))
            ->label('Terug naar objecten') 
            ->link()
            ->color('gray'),
            \EightyNine\ExcelImport\ExcelImportAction::make()
            ->color("success")->label('Importeren')->modalHeading('Selecteer een excel bestand'),
    
            Actions\CreateAction::make()->modalWidth(MaxWidth::Large)->label('Toevoegen')->modalHeading('Toevoegen'),
 
        ];
    }
}
