<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class ProjectSettings extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ? string $navigationGroup = 'Stamgegevens';
    protected static ? string $navigationLabel = 'Projecten';
}
