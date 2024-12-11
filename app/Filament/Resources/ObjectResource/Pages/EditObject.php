<?php

namespace App\Filament\Resources\ObjectResource\Pages;

use App\Filament\Resources\ObjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObject extends EditRecord
{
    protected static string $resource = ObjectResource::class;
    protected static ?string $title = 'Object wijzigen';
  
    protected function getHeaderActions(): array
    {
        return [
     


            Actions\Action::make('cancel_top')
            ->label('Afbreken')
            ->icon('heroicon-o-arrow-uturn-left')
            ->url($this->previousUrl ?? $this->getResource()::getUrl('index'))
            ->iconButton(),


            Actions\DeleteAction::make()
            ->iconButton()
            ->icon('heroicon-o-trash'),

            
            Actions\Action::make('save_top')
            ->action('save')
            ->label('Opslaan'),


        ];
    }

        
    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

      
    public function getSubheading(): ?string
    {
       
        if ($this->getRecord()->location) {

            $location_name = NULL;
            if( $this->getRecord()->location?->name){
                $location_name =  " | " .  $this->getRecord()->location?->name;
            }
            return   $this->getRecord()->location->address . " " . $this->getRecord()->location->zipcode . " "  . $this->getRecord()->location->place .  $location_name ;




        } else {
            return "";
        }
    
    }

    
    protected function getFormActions(): array
    {
        return []; // necessary to remove the bottom actions
    }
    
}
