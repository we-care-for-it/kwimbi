<?php

namespace App\Filament\Resources\KnowledgebaseArticlesResource\Pages;

use App\Filament\Resources\KnowledgebaseArticlesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKnowledgebaseArticles extends ListRecords
{
    protected static string $resource = KnowledgebaseArticlesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
