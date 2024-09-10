<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class General extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ? string $navigationGroup = 'Stamgegevens';
    protected static ? string $navigationLabel = 'Algemeen';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
    
}
