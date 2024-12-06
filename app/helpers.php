<?php
use Filament\Facades\Filament;

    if (! function_exists('get_tenant_id')) {
        function get_tenant_id()
        {    
            return  Filament::getTenant()->id;
        }
    }

?>