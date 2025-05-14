<?php
namespace App\Filament\Resources\RelationResource\Pages;

use App\Filament\Resources\RelationResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Parallax\FilamentComments\Actions\CommentsAction;

class ViewRelation extends ViewRecord
{
    protected static string $resource = RelationResource::class;
    protected function getHeaderActions():
    array {
        return [
            Action::make('back')

                ->label('Terug naar overzicht')
                ->link()
                ->color('gray'),
            Actions\EditAction::make()->icon('heroicon-m-pencil-square')
                ->slideOver(),
            Actions\DeleteAction::make()->icon('heroicon-m-trash'),
            CommentsAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return $this->getRecord()->name;
    }
}
