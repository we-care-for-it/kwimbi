<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectBuildingTypeResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectBuildingTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;
class ListObjectBuildingTypes extends ListRecords
{
    protected static string $resource = ObjectBuildingTypeResource::class;
    protected static ?string $title = 'Gebouw - Types';

    protected function getHeaderActions(): array
    {
        return [
            \EightyNine\ExcelImport\ExcelImportAction::make()
            ->color("success")->label('Importeren')->modalHeading('Selecteer een excel bestand'),
        Actions\CreateAction::make()->label('Toevoegen')->modalHeading('Toevoegen')
        ->modalWidth(MaxWidth::Large),

        ];
    }
}
