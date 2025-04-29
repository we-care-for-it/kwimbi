<?php
namespace App\Filament\Resources\TimeTrackingResource\Pages;

use App\Filament\Resources\TimeTrackingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Parallax\FilamentComments\Actions\CommentsAction;

class ViewTimeTracking extends ViewRecord
{
    protected static string $resource = TimeTrackingResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->label('Wijzigen')->slideOver(),
            CommentsAction::make(),
        ];
    }
}
