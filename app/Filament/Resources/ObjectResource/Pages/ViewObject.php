<?php
namespace App\Filament\Resources\ObjectResource\Pages;

use App\Filament\Resources\ObjectResource;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\ViewRecord;

class ViewObject extends ViewRecord
{
    protected static string $resource = ObjectResource::class;
    protected static ?string $title   = 'Lifteigenschappen';

    public function getSubheading(): ?string
    {

        if ($this->getRecord()->location) {

            $location_name = null;
            if ($this->getRecord()->location?->name) {
                $location_name = " | " . $this->getRecord()->location?->name;
            }
            return $this->getRecord()->location->address . " " . $this->getRecord()->location->zipcode . " " . $this->getRecord()->location->place . $location_name;

        } else {
            return "";
        }

    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('cancel_top')
                ->iconButton()
                ->color('gray')
                ->label('Open locatie')

                ->link()
                ->icon('heroicon-s-map-pin')
                ->url(function ($record) {
                    return "/" . Filament::getTenant()->id . "/object-locations/" . $this->getRecord()->location->id;
                }),

            Actions\EditAction::make('cancel_top')
                ->slideOver()
                ->icon('heroicon-o-pencil')
                ->label('Wijzig'),

        ];
    }

}
