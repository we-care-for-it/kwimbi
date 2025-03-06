<?php

namespace App\Filament\Admin\Resources\ObjectMonitoringResource\Pages;

use App\Filament\Admin\Resources\ObjectMonitoringResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObjectMonitoring extends EditRecord
{
    protected static string $resource = ObjectMonitoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
