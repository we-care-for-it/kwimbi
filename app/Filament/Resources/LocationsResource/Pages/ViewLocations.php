<?php

namespace App\Filament\Resources\LocationsResource\Pages;

use App\Filament\Resources\LocationsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
use Filament\Support\Enums\MaxWidth;
class ViewLocations extends ViewRecord
{
    protected static string $resource = LocationsResource::class;


    protected function getHeaderActions():
    array
    {
        return [
            Action::make('back')
            ->url(route('filament.admin.resources.locations.index'))
            ->label('Terug naar overzicht') 
            ->link()
            ->color('gray'),
            Actions\EditAction::make()->icon('heroicon-m-pencil-square')  ->modalWidth(MaxWidth::SevenExtraLarge),
            Actions\DeleteAction::make()->icon('heroicon-m-trash')
        ];
    }
    // public function getHeading(): string
    // {
    //     return $this->getRecord()->name;
    // }
    // public function getTitle(): string
    // {
    //     return $this->getRecord()->name;
    // }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }


}
