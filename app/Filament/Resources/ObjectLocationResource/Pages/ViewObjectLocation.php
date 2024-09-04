<?php

namespace App\Filament\Resources\ObjectLocationResource\Pages;

use App\Filament\Resources\ObjectLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
use Filament\Support\Enums\MaxWidth;
class ViewObjectLocation extends ViewRecord
{
    protected static string $resource = ObjectLocationResource::class;


protected function getHeaderActions():
array
{
    return [
        Action::make('back')
        ->url(route('filament.admin.resources.object-locations.index'))
        ->label('Terug naar overzicht') 
        ->link()
        ->color('gray'),
        Actions\EditAction::make()->icon('heroicon-m-pencil-square')
            ->modalWidth(MaxWidth::SevenExtraLarge)
            ->after(function (): void {
          
                $this->fillForm();
}),
            
        // Tables\Actions\DeleteAction::make()->modalHeading(
        //     "Verwijderen van deze rij"
    
        Actions\DeleteAction::make()->icon('heroicon-m-trash')->label('Verwijderen')  
    ];
}
// public function getHeading(): string
// {
//     return $this->getRecord()->name;
// }
// public function getTitle(): string
// {
//     return $this->getRecord()->name;
// }

protected function getRedirectUrl(): string
{
    return $this->previousUrl ?? $this->getResource()::getUrl('index');
}

public function getHeading(): string
{
    if($this->getRecord()->name){
      return $this->getRecord()->name;
    }else{
        return 'Locatie bekijken';
    }
   
}



}
