<?php

namespace App\Filament\Resources\SolutionsResource\Pages;

use App\Filament\Resources\SolutionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSolutions extends ManageRecords
{
    protected static string $resource = SolutionsResource::class;
    protected static ?string $title = 'Werkopdracht oplossingen';
    //protected ?string $subheading = 'Deze oplossingen kunnen geselecteerd worden bij de werkbonnen';
    protected static ?string $navigationGroup = 'Basisgegevens';
  
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Toevoegen'),
        ];
    }
}
