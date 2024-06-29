<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class AdminPanel extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
     
     protected static ? string $navigationGroup = 'Systeembeheer';
     protected static ? string $navigationLabel = 'Administrator';
}
 
