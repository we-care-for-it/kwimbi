<?php

namespace App\Filament\Clusters\General\Resources\CompanyCategoriesResource\Pages;

use App\Filament\Clusters\General\Resources\CompanyCategoriesResource;
use Filament\Actions;
use Filament\Support\Enums\MaxWidth;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;

class ListCompanyCategories extends ListRecords
{
    protected static string $resource = CompanyCategoriesResource::class;
    protected static ?string $title = "Relatie categorieën";
    protected function getHeaderActions(): array
    {
        return [

 

            \EightyNine\ExcelImport\ExcelImportAction::make()
                ->label('Importeren')
                ->outlined()
                ->link(),
       
            Actions\CreateAction::make()
                ->label('Toevoegen')
                ->modalWidth(MaxWidth::Large)
                ->modalHeading('Bedrijfcategorie toevoegen'),
        ];
    }
}
