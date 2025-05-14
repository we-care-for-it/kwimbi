<?php
namespace App\Filament\Resources\SpaceResource\Pages;

use App\Filament\Resources\SpaceResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSpace extends ViewRecord
{
    protected static string $resource = SpaceResource::class;

    protected function getHeaderActions():
    array {
        return [
            Action::make('back')

                ->label('Terug naar overzicht')
                ->link()                
                ->url('/spaces')
                ->color('gray'),
            EditAction::make()->icon('heroicon-m-pencil-square')
                ->slideOver(),
            DeleteAction::make()->icon('heroicon-m-trash'),
        ];
    }

    public function getHeading(): string
    {
        return "Bekijk ruimte";
    }

}
