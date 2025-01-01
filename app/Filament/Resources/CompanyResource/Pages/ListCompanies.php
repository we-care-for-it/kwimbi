<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;



class ListCompanies extends ListRecords
{
    protected static string $resource = CompanyResource::class;
    //protected ?string $subheading = 'Custom Page Subheading';
    protected static ?string $title = "Bedrijven overzicht";

    protected function getHeaderActions(): array
    {
        return [

            
            Actions\CreateAction::make()
            ->icon('heroicon-m-plus')
            ->label('Toevoegen')
            ->modalHeading('Bedrijf toevoegen')
            ->slideOver(),

            \EightyNine\ExcelImport\ExcelImportAction::make()->label('Importeren')
            ->color("primary"),

            
        ];
    }


    public function getHeading(): string
    {
      
        return "Bedrijven overzicht";
       
    }

}
