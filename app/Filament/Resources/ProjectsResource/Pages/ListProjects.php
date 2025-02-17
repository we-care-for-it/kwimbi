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

            // Action::make('edit')
            // ->icon('heroicon-o-cog-6-tooth')
            // ->color('gray')
            // ->label('Instellingen')
            // ->link()

            // Actions\CreateAction::make()->icon('heroicon-m-plus')->modalWidth(MaxWidth::SevenExtraLarge)->label('Toevoegen'),
        ];
    }
}
