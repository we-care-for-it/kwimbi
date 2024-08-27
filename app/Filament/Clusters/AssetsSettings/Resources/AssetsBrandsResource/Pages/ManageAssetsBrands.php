<?php

namespace App\Filament\Clusters\AssetsSettings\Resources\AssetsBrandsResource\Pages;

use App\Filament\Clusters\AssetsSettings\Resources\AssetsBrandsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Filters\Layout;
class ManageAssetsBrands extends ManageRecords
{
    protected static string $resource = AssetsBrandsResource::class;
    protected static ? string $title = 'Hardware - Merken';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Toevoegen')
            ->modalHeading('Merk toevoegen'),
        ];
    }
}
