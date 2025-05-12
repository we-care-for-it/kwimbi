<?php
namespace App\Filament\Resources\RelationResource\Pages;

use App\Filament\Resources\RelationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Parallax\FilamentComments\Actions\CommentsAction;

class ViewRelation extends ViewRecord
{
    protected static string $resource = RelationResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->label('Wijzigen')
                ->icon('heroicon-m-pencil-square'),
            CommentsAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return $this->getRecord()->name;
    }
}
