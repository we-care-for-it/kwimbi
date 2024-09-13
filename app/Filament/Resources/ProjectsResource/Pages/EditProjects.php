<?php

namespace App\Filament\Resources\ProjectsResource\Pages;

use App\Filament\Resources\ProjectsResource;
use Filament\Actions;
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
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

}
