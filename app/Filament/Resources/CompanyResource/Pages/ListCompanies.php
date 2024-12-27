<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompanies extends ListRecords
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->icon('heroicon-m-plus')
            ->label('Toevoegen')
            ->modalHeading('Object snel bewerken')
            ->slideOver(),
        ];
    }


    public function getHeading(): string
    {
      
        return "Bedrijven overzicht";
       
    }

}
