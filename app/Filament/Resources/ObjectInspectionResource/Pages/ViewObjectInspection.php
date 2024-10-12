<?php

namespace App\Filament\Resources\ObjectInspectionResource\Pages;

use App\Filament\Resources\ObjectInspectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
class ViewObjectInspection extends ViewRecord
{
    protected static string $resource = ObjectInspectionResource::class;
    

    protected function getHeaderActions(): array
    {
        return [
           
 
            EditAction::make()
            
            ->form([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                // ...
            ])
            
    
 

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



}
