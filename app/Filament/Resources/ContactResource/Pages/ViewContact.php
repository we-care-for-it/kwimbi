<?php
namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Parallax\FilamentComments\Actions\CommentsAction;

class ViewContact extends ViewRecord
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions():
    array {
        return [
            Action::make('back')

                ->label('Terug naar overzicht')
                ->link()
                ->url('/contacts')
                ->color('gray'),
            EditAction::make()->icon('heroicon-m-pencil-square')
                ->slideOver(),
            DeleteAction::make()->icon('heroicon-m-trash'),
            CommentsAction::make(),
        ];
    }
}
