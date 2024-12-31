<?php

namespace App\Filament\Clusters\General\Resources\ObjectTypeResource\Pages;

use App\Filament\Clusters\General\Resources\ObjectTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObjectType extends EditRecord
{
    protected static string $resource = ObjectTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
