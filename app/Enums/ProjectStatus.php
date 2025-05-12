<?php
namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ProjectStatus: string implements HasLabel {
    case CONCEPT     = '1';
    case PLANNED     = '2';
    case IN_PROGRESS = '3';
    case ON_HOLD     = '4';
    case TO_INVOICE  = "5";
    case CANCELLED   = '6';
    case COMPLETED   = '7';
    case EVALUATION  = '8';

    public function getlabel(): string
    {
        return match ($this) {
            self::CONCEPT => 'Concept',
            self::PLANNED => 'Gepland',
            self::IN_PROGRESS => 'In uitvoering',
            self::ON_HOLD => 'Gepauzeerd',
            self::TO_INVOICE => 'Te factueren',
            self::CANCELLED => 'Geannuleerd',
            self::COMPLETED => 'Afgerond',
            self::EVALUATION => 'Nazorg / Evaluatie',
            // self::STANDSTILL => 'Stilstaand',
        };
    }

    // public function getIcon(): ?string
    // {
    //     return match ($this) {
    //         self::EXTERN => 'heroicon-o-cpu-chip',
    //         self::INTERN => 'heroicon-m-check'
    //     };
    // }

}
