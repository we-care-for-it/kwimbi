<?php
namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewCompany extends ViewRecord
{
    protected static string $resource = CompanyResource::class;

    protected static ?string $title = 'Bekijk bedrijf';

    protected function getHeaderActions():
    array {
        return [
            Action::make('back')
                ->url(route('filament.app.resources.companies.index'))
                ->label('Terug naar overzicht')
                ->link()
                ->color('gray'),
            Actions\EditAction::make()
                ->modalHeading('Bedrijf bewerken')
            ,
        ];
    }

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    {
        $this->getRecord()?->name;
    }

    public function getSubheading(): ?string
    {

        if ($this->getRecord()->address) {

            return $this->getRecord()?->address . " " . $this->getRecord()?->zipcode . " " . $this->getRecord()?->place;

        } else {
            return "";
        }

    }
}
