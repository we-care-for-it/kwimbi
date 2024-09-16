<?php

namespace App\Filament\Resources\ProjectsResource\Pages;

use App\Filament\Resources\ProjectsResource;
use Filament\Actions;
use Filament\Resources\Pages\ContentTabPosition;
use Filament\Resources\Pages\EditRecord;

class EditProjects extends EditRecord
{
    protected static string $resource = ProjectsResource::class;
    protected static ?string $title = 'Project bekijken';

    public static function getRelations(): array
    {
        return [
            RelationManagers\ReactionsRelationManager::class,
            RelationManagers\UploadsRelationManager::class,
            RelationManagers\LocationsRelationManager::class
        ];
    }


    public function getContentTabPosition(): ?ContentTabPosition
    {
        return ContentTabPosition::After;
    }

    public function refreshForm()
    {
        $this->fillForm();
    }

    public function getHeading(): string
    {
        return "#" . sprintf('%05d', $this->getRecord()->id) . " - " . $this->getRecord()->name;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('save_top')
                ->action('save'),
            Actions\Action::make('cancel_top')
                ->url($this->getResource()::getUrl('index'))
                ->outlined(),
            Actions\DeleteAction::make(),
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
