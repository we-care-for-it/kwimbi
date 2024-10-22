<?php

namespace App\Filament\Resources\ObjectInspectionResource\Pages;

use App\Filament\Resources\ObjectInspectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Support\Enums\MaxWidth;
//Form
 
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

class ViewObjectInspection extends ViewRecord
{
    protected static string $resource = ObjectInspectionResource::class;
    protected static ?string $title = 'Keuringsrapportage';
  

    protected function getHeaderActions(): array
    {
        return [
           
 

            
            Actions\Action::make('cancel_top')
            ->link()
            ->label('Terug')
            ->icon('heroicon-o-arrow-uturn-left')
            ->url($this->previousUrl ?? $this->getResource()::getUrl('index'))
            ->color("danger")
            ->iconButton(),

            Actions\EditAction::make('cancel_top')
            ->link()
            ->label('Wijzig'),
  
            

            Actions\Action::make("Downloaddocument")->color("warning")  
            ->label("Download rapport")
            ->icon("heroicon-o-document-arrow-down")
            ->link()
            ->fillForm(
                fn($record): array => [
                    "filename" =>
                        $record->status_id->getlabel() .
                        " - Report - ". 
                        $record?->elevator?->location?->address .
                        ", " .
                        $record?->elevator?->location?->place,
                ]
            )
            ->action(function ($data, $record) {
                $contents = base64_decode($record->document);
                $path = public_path($data["filename"] . ".pdf");
            
                file_put_contents($path, $contents);
            
                return response()
                    ->download($path)
                    ->deleteFileAfterSend(true);
            })
            ->modalWidth(MaxWidth::Large)
            ->modalHeading("Bestand downlaoden")
            ->modalDescription(
                "Geef een bestandsnaam om om het bestand te downloaden"
            )
            
            ->form([
              TextInput::make("filename")
                    ->label("Bestandsnaam")
                    ->required(),
            ])
        ->visible(fn($record) => $record?->document ?? true),

 
      
    
 

        ];
    }


    public function getSubheading(): ?string
    {
       
        if ($this->getRecord()->if_match) {
            return  "Geimporteerd vanuit de koppeling met " . $this->getRecord()->inspectioncompany->name ;
        } else {
            return "";
        }
    
    }



}
