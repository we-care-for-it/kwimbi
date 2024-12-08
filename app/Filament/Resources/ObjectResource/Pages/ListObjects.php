<?php

namespace App\Filament\Resources\ObjectResource\Pages;

use App\Filament\Resources\ObjectResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListObjects extends ListRecords
{
    protected static string $resource = ObjectResource::class;

    protected static ?string $title = 'Alle objecten';

    //protected ?string $subheading = 'Custom Page Subheading';
    protected function getHeaderActions(): array
    {
        return [
            Action::make('edit')
                ->icon('heroicon-o-cog-6-tooth')
                ->color('gray')
                ->label('Instellingen')
                ->link()
                ->url(route('filament.admin.elevators-settings')),

            Actions\CreateAction::make()->icon('heroicon-m-plus')->label('Toevoegen'),
        ];
    }
}
