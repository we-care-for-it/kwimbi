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
            \EightyNine\ExcelImport\ExcelImportAction::make()
                ->color("primary")
                ->slideOver()
                ->link()
                ->beforeImport(function ($data, $livewire, $excelImportAction) {
                    $excelImportAction->additionalData([
                        'company_id' => Filament::getTenant()->id,
                    ]);
                }),

            Actions\CreateAction::make(),

        ];
    }
}
