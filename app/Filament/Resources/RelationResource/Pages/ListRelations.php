<?php
namespace App\Filament\Resources\RelationResource\Pages;

use App\Filament\Resources\RelationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;
use Relaticle\CustomFields\Filament\Tables\Concerns\InteractsWithCustomFields;

class ListRelations extends ListRecords
{
    use InteractsWithCustomFields;
    protected static string $resource = RelationResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalWidth(MaxWidth::FourExtraLarge)
                ->modalHeading('Relatie toevoegen')
                ->modalDescription('Voeg een nieuwe relatie toe door de onderstaande gegeven zo volledig mogelijk in te vullen.')
                ->icon('heroicon-m-plus')
                ->modalIcon('heroicon-o-plus')
                ->slideOver()
                ->label('Relatie toevoegen'),
        ];
    }
    public function getHeading(): string
    {
        return "Relatie - Overzicht";
    }
}
