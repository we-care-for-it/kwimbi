<?php
namespace App\Filament\App\Resources\ProjectsResource\Pages;

use App\Filament\App\Resources\ProjectsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
class ViewProjects extends ViewRecord
{
    protected static string $resource = ProjectsResource::class;
    protected static ?string $title = 'Projecten';

    protected function getHeaderActions():
        array
        {
            return [
                Action::make('back')
               // ->url(route('filament.admin.resources.tools.index'))
                ->label('Terug naar overzicht') 
                ->link()
                ->color('gray'),
                Actions\EditAction::make()->icon('heroicon-m-pencil-square'),
                Actions\DeleteAction::make()->icon('heroicon-m-trash')
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
        
