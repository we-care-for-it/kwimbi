<?php

namespace App\Enums;


use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;


 

enum ElevatorStatus: string implements HasLabel,HasColor
{
    case OPERATIONAL = "1";
    case TURNEDOFF   = "2";


    
 


    public function getlabel(): string
    {
        return match ($this) {
            self::OPERATIONAL => 'Operationeel',
            self::TURNEDOFF => 'Buitenbedrijf',

        };
    }

    // public function getIcon(): ?string
    // {
    //     return match ($this) {
    //         self::EXTERN => 'heroicon-o-cpu-chip',
    //         self::INTERN => 'heroicon-m-check'
    //     };
    // }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::OPERATIONAL => 'success',
            self::TURNEDOFF => 'danger',
        };
    }
}

