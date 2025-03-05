<?php
namespace App\Filament\Resources\ObjectResource\Pages;

use App\Filament\Resources\ObjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;

class ListObjects extends ListRecords
{
    protected static string $resource = ObjectResource::class;

    protected static ?string $title = 'Objecten';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalWidth(MaxWidth::FourExtraLarge)
                ->modalHeading('Object toevoegen')
                ->modalDescription('Voeg een nieuwe object toe door de onderstaande gegeven zo volledig mogelijk in te vullen.')
                ->icon('heroicon-m-plus')
                ->modalIcon('heroicon-o-plus')
                ->slideOver()
                ->label('Object toevoegen'),
        ];
    }
    public function getHeading(): string
    {
        return "Object - Overzicht";
    }
}
