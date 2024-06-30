<?php

namespace App\Filament\Clusters\ToolsSettings\Resources\ToolsCategoriesResource\Pages;

use App\Filament\Clusters\ToolsSettings\Resources\ToolsCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;



class ManageToolsCategories extends ManageRecords
{

    protected static ?string $title = 'Gereedschap - Categorieën';

    protected static string $resource = ToolsCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Toevoegen'),
        ];
    }
}
