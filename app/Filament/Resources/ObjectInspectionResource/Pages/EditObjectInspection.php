<?php

namespace App\Filament\Resources\ObjectInspectionResource\Pages;

use App\Filament\Resources\ObjectInspectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObjectInspection extends EditRecord
{
    protected static string $resource = ObjectInspectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
           
 
            Actions\DeleteAction::make()
            ->link()
       
            ->icon('heroicon-o-trash'),
     

    
                Actions\Action::make('cancel_top')
            ->link()
            ->label('Afbreken')
            ->icon('heroicon-o-arrow-uturn-left')
            ->url($this->previousUrl ?? $this->getResource()::getUrl('index'))
            ->outlined(),

            
    

            
        Actions\Action::make('save_top')
            ->action('save')
       
            ->label('Gegevens opslaan'),

        ];
    }


    protected function getFormActions(): array
    {
        return []; // necessary to remove the bottom actions
    }
    
    

    public function getSubheading(): ?string
    {
       
        if ($this->getRecord()->if_match) {



            return  "Geimporteerd vanuit de keuringsinstantie koppeling"  ;
        } else {
            return "";
        }
    }

    
    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

}
