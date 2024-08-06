<?php

namespace App\Filament\Clusters\ProjectSettings\Resources\HourTypesResource\Pages;

use App\Filament\Clusters\ProjectSettings\Resources\HourTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;
class ManageHourTypes extends ManageRecords
{
    protected static string $resource = HourTypesResource::class;
    protected static ?string $title = 'Projecten - Uurtypes';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()  ->modalHeading('Toevoegen')->label('Toevoegen')->modalWidth(MaxWidth::ExtraLarge),

        ];
    }
}
