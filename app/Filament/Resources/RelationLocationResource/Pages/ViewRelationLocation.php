<?php
namespace App\Filament\Resources\RelationLocationResource\Pages;

use App\Filament\Resources\RelationLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Parallax\FilamentComments\Actions\CommentsAction;

class ViewRelationLocation extends ViewRecord
{
    protected static string $resource = RelationLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->label('Wijzigen')->slideOver()
                ->icon('heroicon-m-pencil-square'),
            CommentsAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return $this->getRecord()->name;
    }
}
