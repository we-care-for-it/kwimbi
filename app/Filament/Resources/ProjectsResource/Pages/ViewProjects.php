<?php
namespace App\Filament\Resources\ProjectsResource\Pages;

use App\Filament\Resources\ProjectsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProjects extends ViewRecord
{
    protected static string $resource = ProjectsResource::class;
    protected static ?string $title = 'Projecten';

    protected function getHeaderActions():
        array
        {
            return [
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
            return 'Wijzig: ' . $this->getRecord()->name;
        }
        public function getTitle(): string
        {
            return 'Wijzig: ' . $this->getRecord()->name;
        }
 


 

           
            
        }
        
