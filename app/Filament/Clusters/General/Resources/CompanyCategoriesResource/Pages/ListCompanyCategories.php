<?php

namespace App\Filament\Clusters\General\Resources\CompanyCategoriesResource\Pages;

use App\Filament\Clusters\General\Resources\CompanyCategoriesResource;
use Filament\Actions;
use Filament\Support\Enums\MaxWidth;
use Filament\Resources\Pages\ListRecords;

class ListCompanyCategories extends ListRecords
{
    protected static string $resource = CompanyCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Toevoegen')
                ->modalWidth(MaxWidth::Large)
                ->modalHeading('Bedrijfcategorie toevoegen'),
        ];
    }
}
