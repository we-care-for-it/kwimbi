<?php

namespace App\Filament\Resources\ProjectsResource\Pages;

use App\Filament\Resources\ProjectsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Filament\Support\Enums\MaxWidth;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectsResource::class;
    protected static ?string $title = 'Projecten';
    protected function getHeaderActions(): array
    {
        return [


            Action::make('edit')
            ->icon('heroicon-o-cog-6-tooth')
            ->color('gray')
            ->label('Instellingen')
            ->link()
            ->url(route('filament.admin.project-settings')),

            Actions\CreateAction::make()->icon('heroicon-m-plus')->modalWidth(MaxWidth::SevenExtraLarge)->label('Toevoegen'),
        ];
    }
}
