<?php

namespace App\Filament\App\Resources\ObjectLocationResource\Pages;

use App\Filament\App\Resources\ObjectLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateObjectLocation extends CreateRecord
{
    protected static string $resource = ObjectLocationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

}
