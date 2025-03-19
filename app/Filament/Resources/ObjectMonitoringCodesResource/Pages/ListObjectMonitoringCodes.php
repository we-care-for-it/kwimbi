<?php
namespace App\Filament\Resources\ObjectMonitoringCodesResource\Pages;

use App\Filament\Resources\ObjectMonitoringCodesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectMonitoringCodes extends ListRecords
{
    protected static string $resource = ObjectMonitoringCodesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \EightyNine\ExcelImport\ExcelImportAction::make()
                ->label('Importeren')
                ->outlined()
                ->link()
                ->color('primary'),

            Actions\CreateAction::make()->label('Toevoegen'),
        ];
    }
}
