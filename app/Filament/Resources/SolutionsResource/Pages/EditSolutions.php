<?php

namespace App\Filament\Resources\SolutionsResource\Pages;

use App\Filament\Resources\SolutionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSolutions extends EditRecord
{
    protected static string $resource = SolutionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
