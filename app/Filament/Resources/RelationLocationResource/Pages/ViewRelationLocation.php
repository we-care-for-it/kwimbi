<?php
namespace App\Filament\Resources\RelationLocationResource\Pages;

use App\Filament\Resources\RelationLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRelationLocation extends ViewRecord
{
    protected static string $resource = RelationLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label("Wijzig")
                ->modalHeading('Locatie Bewerken')
                ->modalDescription('Pas de bestaande locatie aan door de onderstaande gegevens zo volledig mogelijk in te vullen.')
                ->tooltip('Bewerken')
                ->modalIcon('heroicon-o-pencil')
                ->slideOver(),

        ];
    }
}
