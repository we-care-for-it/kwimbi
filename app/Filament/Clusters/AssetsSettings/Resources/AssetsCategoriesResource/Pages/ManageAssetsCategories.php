<?php

namespace App\Filament\Clusters\AssetsSettings\Resources\AssetsCategoriesResource\Pages;

use App\Filament\Clusters\AssetsSettings\Resources\AssetsCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAssetsCategories extends ManageRecords
{
    protected static string $resource = AssetsCategoriesResource::class;
    protected static ? string $title = 'Hardware - Categorieën';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Toevoegen')
            ->modalHeading('Merk toevoegen'),
        ];
    }
}
