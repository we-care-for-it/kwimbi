<?php

namespace App\Filament\Clusters\General\Resources\CompanyCategoriesResource\Pages;

use App\Filament\Clusters\General\Resources\CompanyCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanyCategories extends EditRecord
{
    protected static string $resource = CompanyCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
