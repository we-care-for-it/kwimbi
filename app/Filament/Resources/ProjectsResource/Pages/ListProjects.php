<?php
namespace App\Filament\Resources\ProjectsResource\Pages;

use App\Filament\Resources\ProjectsResource;
use Filament\Resources\Pages\ListRecords;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectsResource::class;
    protected static ?string $title   = 'Projecten';
    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make()
            //     ->modalWidth(MaxWidth::FourExtraLarge)
            //     ->modalHeading('Project toevoegen')
            //     ->modalDescription('Voeg een nieuwe project toe door de onderstaande gegeven zo volledig mogelijk in te vullen.')
            //     ->icon('heroicon-m-plus')
            //     ->modalIcon('heroicon-o-plus')
            //     ->slideOver()
            //     ->label('Project toevoegen'),
        ];
    }
    public function getHeading(): string
    {
        return "Project - Overzicht";
    }
}
