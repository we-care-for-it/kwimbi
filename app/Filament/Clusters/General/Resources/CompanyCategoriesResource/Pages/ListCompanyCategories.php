<?php

namespace App\Filament\Clusters\General\Resources\CompanyCategoriesResource\Pages;

use App\Filament\Clusters\General\Resources\CompanyCategoriesResource;
use Filament\Actions;
use Filament\Support\Enums\MaxWidth;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;

class ListCompanyCategories extends ListRecords
{
    protected static string $resource = CompanyCategoriesResource::class;
    protected static ?string $title = "Bedrijfscategorieën";
    protected function getHeaderActions(): array
    {
        return [

            Actions\Action::make('cancel_top')
            ->link()
            ->label('Afbreken')
            ->url($this->getResource()::getUrl('index'))
            ->outlined(),

            Actions\CreateAction::make()
                ->label('Toevoegen')
                ->modalWidth(MaxWidth::Large)
                ->modalHeading('Bedrijfcategorie toevoegen'),
        ];
    }
}
