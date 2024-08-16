<?php

namespace App\Filament\Clusters\ProjectSettings\Resources\HourTypesResource\Pages;

use App\Filament\Clusters\ProjectSettings\Resources\HourTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;
use Filament\Actions\Action;


class ManageHourTypes extends ManageRecords
{
    protected static string $resource = HourTypesResource::class;
    protected static ?string $title = 'Projecten - Uurtypes';
 
 
}
//filament.{panel_id}.resources.{resource_name}