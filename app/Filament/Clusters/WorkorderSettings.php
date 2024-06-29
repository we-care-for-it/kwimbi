<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class WorkorderSettings extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
 
    protected static ? string $navigationGroup = 'Instellingen';
    protected static ? string $navigationLabel = 'Werkopdrachten';
}
