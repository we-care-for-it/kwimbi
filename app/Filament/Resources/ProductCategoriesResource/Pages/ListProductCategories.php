<?php

namespace App\Filament\Resources\ProductCategoriesResource\Pages;

use App\Filament\Resources\ProductCategoriesResource;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;

class ListProductCategories extends ListRecords
{
    protected static string $resource = ProductCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalWidth(MaxWidth::FourExtraLarge)
                ->modalHeading('Productcategorie toevoegen')
                ->modalDescription('Voeg een nieuwe productcategorie toe door de onderstaande gegevens zo volledig mogelijk in te vullen.')
                ->icon('heroicon-m-plus')
                ->modalIcon('heroicon-o-plus')
                ->slideOver()
                ->label('Productcategorie toevoegen'),
        ];
    }

    public function getHeading(): string
    {
        return "Productcategorieën - Overzicht";
    }
}