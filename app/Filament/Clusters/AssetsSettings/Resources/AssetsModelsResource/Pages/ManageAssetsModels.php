<?php

namespace App\Filament\Clusters\AssetsSettings\Resources\AssetsModelsResource\Pages;

use App\Filament\Clusters\AssetsSettings\Resources\AssetsModelsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;
class ManageAssetsModels extends ManageRecords
{
    
    protected static string $resource = AssetsModelsResource::class;
    protected static ? string $title = 'Hardware - Modellen';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Toevoegen')
            ->modalHeading('Merk toevoegen')   ->modalWidth(MaxWidth::FiveExtraLarge),
        ];
    }
}
