<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class ElevatorsSettings extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ? string $navigationGroup = 'Instellingen';
    protected static ? string $navigationLabel = 'Liften';
    protected static ? string $cluster = AdminPanel::class;

}
