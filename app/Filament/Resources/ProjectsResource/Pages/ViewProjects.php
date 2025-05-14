<?php
namespace App\Filament\Resources\ProjectsResource\Pages;

use App\Filament\Resources\ProjectsResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Actions\ActionGroup;
use Parallax\FilamentComments\Actions\CommentsAction;

class ViewProjects extends ViewRecord
{
    protected static string $resource = ProjectsResource::class;
    protected static ?string $title   = 'Projecten';

    protected function getHeaderActions():
    array {
        return [
            Action::make('back')
                ->label('Terug naar overzicht')
                ->link()
                ->color('gray'),

            Actions\EditAction::make()->icon('heroicon-m-pencil-square')
                ->slideOver(),

            CommentsAction::make(),

            ActionGroup::make([
                Actions\DeleteAction::make('Verwijderen'),
            ]),

        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // ProjectsResource\Widgets\ProjectCounters::class,
        ];
    }

    public function getHeading(): string
    {
        return $this->getRecord()->name;
    }
    public function getTitle(): string
    {
        return $this->getRecord()->name;
    }

}
