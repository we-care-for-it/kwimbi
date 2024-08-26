<?php

namespace App\Filament\Clusters\General\Resources\ExternalResource\Pages;

use App\Filament\Clusters\General\Resources\ExternalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateExternal extends CreateRecord
{
    protected static string $resource = ExternalResource::class;
}
