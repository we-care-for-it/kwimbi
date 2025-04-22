<?php
namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum LocationType: string implements HasLabel {
    case PARENT = '1';
    case SECOND = '2';

    public function getlabel(): string
    {
        return match ($this) {
            self::PARENT => 'Hoofdlocatie',
            self::SECOND => 'Neven locatie',

        };
    }

    // public function getIcon(): ?string
    // {
    //     return match ($this) {
    //         self::EXTERN     => 'heroicon-o-cpu-chip',
    //         self::INTERN     => 'heroicon-m-check',
    //     };
    // }

    // public function getColor(): string | array | null
    // {
    //     return match ($this) {
    //         self::EXTERN     => 'gray',
    //         self::INTERN     => 'warning',
    //     };
    // }
}
