<?php

namespace App\Enums;


use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;


 

enum IncidentStatus: string implements HasLabel,HasColor
{
    case STATUS01 = "1";
    case STATUS02 = "2";
    case STATUS03 = "3";
    case STATUS04 = "4";

    
    public function label(): string
{
    return match($this)
    {
        self::STATUS01 => 'Nieuw',
        self::STATUS02 => 'Wacht op klant ',
        self::STATUS03 => 'Wacht op leveranier',
        self::STATUS04 => 'Gesloten',
   };
}



    public function getlabel(): string
    {
        return match ($this) {
            self::STATUS01 => 'Nieuw',
            self::STATUS02 => 'Wacht op klant ',
            self::STATUS03 => 'Wacht op leveranier',
            self::STATUS04 => 'Gesloten'
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
            self::STATUS01 => 'Nieuw',
            self::STATUS02 => 'Wacht op klant ',
            self::STATUS03 => 'Wacht op leveranier',
            self::STATUS04 => 'Gesloten',
        };
    }
}

