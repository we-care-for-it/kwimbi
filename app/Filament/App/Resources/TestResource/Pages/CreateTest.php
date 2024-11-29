<?php

namespace App\Filament\App\Resources\TestResource\Pages;

use App\Filament\App\Resources\TestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTest extends CreateRecord
{
    protected static string $resource = TestResource::class;
}
