<?php
namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum Priority: string implements HasLabel, HasColor {
    case HIGH   = '1';
    case MEDIUM = '2';
    case LOW    = '3';

    public function getlabel(): string
    {
        return match ($this) {
            self::HIGH   => 'Hoog',
            self::MEDIUM => 'Gemiddeld',
            self::LOW    => 'Laag',

        };
    }

    // public function getIcon(): ?string
    // {
    //     return match ($this) {
    //         self::EXTERN => 'heroicon-o-cpu-chip',
    //         self::CLOSED => 'heroicon-m-check',
    //     };
    // }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::HIGH   => 'danger',
            self::MEDIUM => 'warning',
            self::LOW    => 'success',
        };
    }
}
