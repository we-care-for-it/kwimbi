<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class General extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ? string $navigationGroup = 'Stamgegevens';
    protected static ? string $navigationLabel = 'Algemeen';

    public static function shouldRegisterNavigation(): bool
{
  return false;
}
}
