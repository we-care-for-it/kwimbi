<?php

namespace App\Filament\Resources;

use Z3d0X\FilamentLogger\Resources\ActivityResource as BaseResource;


//Clusters
use App\Filament\Clusters\AdminPanel;


class ActivityResource extends BaseResource
{

    protected static bool $shouldRegisterNavigation = false;
    protected static ? string $navigationGroup = 'Logboeken';
    protected static ? string $navigationLabel = 'Foutmeldingen';
    protected static ? string $cluster = AdminPanel::class;
 

    /**
     * The resource navigation sort order.
     */
    protected static ?int $navigationSort = 1;

    /**
     * Get the navigation badge for the resource.
     */

    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getModel()::count());
    }
}
