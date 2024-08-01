<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

use Hexters\HexaLite\Traits\HexAccess;

class ToolsSettings extends Cluster
{

    use HexAccess;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ? string $navigationGroup = 'Stamgegevens';
    protected static ? string $navigationLabel = 'Gereedschap';



     
    protected static ?string $permissionId = 'access.masterdata.tools';
 
    protected static ?string $descriptionPermission = ', ';
    
    
    
        protected static ?array $subPermissions = [
            'access.masterdata.tools' => 'Beheer van leveranciers, Categorieën,Merken, Types, Keuringsbedrijven en methodes',
  
        ];
         
        public static function canAccess(array $parameters = []): bool
        {
    
            return hexa()->can(static::$permissionId);
           // return hexa()->can('access.tools.index');
        }
    }



