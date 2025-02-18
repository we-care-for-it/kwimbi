<?php

 
namespace App\Filament\Clusters\General\Resources\ExternalResource\Pages;

use App\Filament\Clusters\General\Resources\ExternalResource;


use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;

class ManageExternal extends ManageRecords
{
    protected static string $resource = ExternalResource::class;
    protected static ?string $title = 'Externe koppelingen';

    protected function getHeaderActions(): array
    {
        return [
            // \EightyNine\ExcelImport\ExcelImportAction::make()
            //     ->color("success")->label('Importeren')->modalHeading('Selecteer een excel bestand'),
               Actions\CreateAction::make()->label('Toevoegen')->modalHeading('Toevoegen')->modalWidth(MaxWidth::ExtraLarge),
 
        ];
    }
}
