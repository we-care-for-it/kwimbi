<?php

namespace App\Filament\App\Resources\ObjectLocationResource\Pages;

use App\Filament\App\Resources\ObjectLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\MaxWidth;


class ViewObjectLocation extends ViewRecord
{
    protected static string $resource = ObjectLocationResource::class;
    protected function getHeaderActions(): array
    {
        return [
      Actions\EditAction::make()->label('Wijzigen')
      ->modalWidth(MaxWidth::SevenExtraLarge),
        ];
    }


}
