<?php

namespace App\Filament\Admin\Resources\ApitokenResource\Pages;

use App\Filament\Admin\Resources\ApitokenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApitokens extends ListRecords
{
    protected static string $resource = ApitokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
