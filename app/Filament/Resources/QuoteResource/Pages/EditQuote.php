<?php

namespace App\Filament\Resources\QuoteResource\Pages;

use App\Filament\Resources\QuoteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuote extends EditRecord
{
    protected static string $resource = QuoteResource::class;
    protected static ?string $title = 'Offerte bekijken';
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->link()
                ->icon('heroicon-o-trash'),
            Actions\Action::make('cancel_top')
                ->link()
                ->label('Afbreken')
                ->url($this->getResource()::getUrl('index'))
                ->outlined(),
            Actions\Action::make('save_top')
                ->action('save')
                ->label('Opslaan')
            ,
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getFormActions(): array
    {
        return []; // necessary to remove the bottom actions
    }



}
