<?php

namespace App\Filament\App\Resources\ObjectResource\Pages;

use App\Filament\App\Resources\ObjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObject extends EditRecord
{
    protected static string $resource = ObjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->link()
                ->icon('heroicon-o-trash'),    
            Actions\Action::make('cancel_top')
                ->link()
                ->label('Afbreken')
                ->icon('heroicon-o-arrow-uturn-left')
                ->url($this->getResource()::getUrl('index'))
                ->outlined(),
            Actions\Action::make('save_top')
                ->action('save')
                ->label('Opslaan'),
        ];
    }
 
}
