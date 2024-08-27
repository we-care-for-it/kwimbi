<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class AssetsSettings extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
 protected static bool $shouldRegisterNavigation = false;
    
 public static function shouldRegisterNavigation(): bool
{
    return false;
}
 
}
