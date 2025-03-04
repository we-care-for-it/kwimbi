<?php
namespace App\Filament\Resources\RelationResource\Pages;

use App\Filament\Resources\RelationResource;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\ListRecords;

class ListRelations extends ListRecords
{
    protected static string $resource = RelationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // \EightyNine\ExcelImport\ExcelImportAction::make()
            //     ->color("primary")
            //     ->label('')
            //     ->color('secondary')
            //     ->slideOver()
            //     ->link()
            //     ->beforeImport(function ($data, $livewire, $excelImportAction) {
            //         $excelImportAction->additionalData([
            //             'company_id' => Filament::getTenant()->id,
            //         ]);
            //     }),

            Actions\CreateAction::make()
                ->label('Toevoegen')->slideOver()
                ->modalHeading('Relatie toevoegen')
                ->modalDescription('Vul de onderstaande gegevens in om de relatie aan te maken in het systeem')
                ->modalSubmitActionLabel('Opslaan')
                ->modalIcon('heroicon-o-plus'),
        ];
    }
}
