<?php

namespace App\Filament\Clusters\General\Resources\ExternalResource\Pages;

use App\Filament\Clusters\General\Resources\ExternalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExternal extends EditRecord
{
    protected static string $resource = ExternalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
