<?php

namespace App\Filament\Resources\ElevatorsResource\Pages;

use App\Filament\Resources\ElevatorsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
class ListElevators extends ListRecords
{
    protected static string $resource = ElevatorsResource::class;
    protected static ?string $title = 'Objecten';
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
