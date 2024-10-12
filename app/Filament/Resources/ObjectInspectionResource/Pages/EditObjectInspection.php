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
            Actions\DeleteAction::make(),
        ];
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
