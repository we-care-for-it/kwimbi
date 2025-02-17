<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use pxlrbt\FilamentActivityLog\Pages\ListActivities;
use App\Filament\Admin\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserActivities extends ListActivities
{
    protected static bool $isScopedToTenant = false;
    protected static string $resource = UserResource::class;
}
