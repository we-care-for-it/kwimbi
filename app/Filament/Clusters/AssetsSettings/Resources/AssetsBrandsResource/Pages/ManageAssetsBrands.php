<?php

namespace App\Filament\Clusters\AssetsSettings\Resources\AssetsBrandsResource\Pages;

use App\Filament\Clusters\AssetsSettings\Resources\AssetsBrandsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAssetsBrands extends ManageRecords
{
    protected static string $resource = AssetsBrandsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
