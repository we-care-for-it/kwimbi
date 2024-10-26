<?php

namespace App\Filament\Resources\ObjectInspectionResource\Pages;

use App\Filament\Resources\ObjectInspectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObjectInspection extends EditRecord
{
    protected static string $resource = ObjectInspectionResource::class;
    protected static ?string $title = 'Keuringsrapportage bewerken';
  
    protected function getHeaderActions(): array
    {
        return [
           
 



                Actions\DeleteAction::make()
                ->iconButton()
                ->icon('heroicon-o-trash'),

            // Actions\Action::make('cancel_top')
            //     ->label('Afbreken')
            //     ->icon('heroicon-o-arrow-uturn-left')
            //     ->url($this->previousUrl ?? $this->getResource()::getUrl('index'))
            //     ->iconButton(),
                

                Actions\Action::make('save_top')
                ->action('save')
                ->label('Opslaan'),
        ];
    }


    protected function getFormActions(): array
    {
        return []; // necessary to remove the bottom actions
    }
    
    

    public function getSubheading(): ?string
    {
        if ($this->getRecord()->if_match) {
            return  "Geimporteerd vanuit de koppeling met " . $this->getRecord()->inspectioncompany->name ;
        } else {
            return "";
        }
    
    }

    
    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

}
