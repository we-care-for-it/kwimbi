<?php

namespace App\Filament\Clusters\ProjectSettings\Resources\ProjectStatusesResource\Pages;

use App\Filament\Clusters\ProjectSettings\Resources\ProjectStatusesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;
use Filament\Actions\Action;

class ManageProjectStatuses extends ManageRecords
{
    protected static string $resource = ProjectStatusesResource::class;
    protected static ?string $title = 'Projecten - Statussen';
 
    protected function getHeaderActions(): array
    {
        return [
          
            Actions\CreateAction::make()  ->modalHeading('Toevoegen')->icon('heroicon-m-plus')->label('Toevoegen')->modalWidth(MaxWidth::ExtraLarge),

        ];
    }
}
