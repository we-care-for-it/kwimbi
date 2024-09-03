<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectInspecectionsZincodesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectInspecectionsZincodesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Actions\Action;
class ManageObjectInspecectionsZincodes extends ManageRecords
{
    protected static string $resource = ObjectInspecectionsZincodesResource::class;
    protected static ?string $title = 'Objecten - ZIN Codes';

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
            Actions\CreateAction::make()->label('Toevoegen')->modalHeading('Toevoegen'),
        ];
    }
}
