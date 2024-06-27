<?php

namespace App\Filament\Resources\KnowledgebaseCategoriesResource\Pages;

use App\Filament\Resources\KnowledgebaseCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKnowledgebaseCategories extends EditRecord
{
    protected static string $resource = KnowledgebaseCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
