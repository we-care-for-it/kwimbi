<?php

namespace App\Filament\Resources\ObjectLocationResource\Pages;

use App\Filament\Resources\ObjectLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
class EditObjectLocation extends EditRecord
{
    protected static string $resource = ObjectLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Actions\Action::make('back')
                ->url(route('filament.admin.resources.object-locations.index'))
                ->label('Terug naar overzicht')
                ->link()
                ->color('gray'),

            Actions\DeleteAction::make()->icon('heroicon-m-trash')   ->outlined()->color('danger')        ];
    }
}
