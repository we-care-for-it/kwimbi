<?php

namespace App\Filament\Pages;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Forms\Components\TextInput;



class Dashboard extends \Filament\Pages\Dashboard
{
   public function getColumns(): int | string | array
{
 
    return 12;
}



}
