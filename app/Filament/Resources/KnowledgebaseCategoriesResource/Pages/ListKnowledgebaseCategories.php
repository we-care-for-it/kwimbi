<?php

namespace App\Filament\Resources\KnowledgebaseCategoriesResource\Pages;

use App\Filament\Resources\KnowledgebaseCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKnowledgebaseCategories extends ListRecords
{
    protected static string $resource = KnowledgebaseCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
