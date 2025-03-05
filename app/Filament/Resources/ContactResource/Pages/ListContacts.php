<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;


class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;
    protected static ?string $title = "Contactpersonen";
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalWidth(MaxWidth::FourExtraLarge)
                ->modalHeading('Contact toevoegen')
                ->modalDescription('Voeg een nieuwe contact toe door de onderstaande gegeven zo volledig mogelijk in te vullen.')
                ->icon('heroicon-m-plus')
                ->modalIcon('heroicon-o-plus')
                ->slideOver()
                ->label('Contact toevoegen'),
        ];
    }
    public function getHeading(): string
    {
      
        return "Contact - Overzicht";
       
    }
}
