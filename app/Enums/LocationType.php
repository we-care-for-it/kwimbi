<?php
namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum LocationType: string implements HasLabel, HasColor, HasIcon {
    case PARENT = '1';
    case SECOND = '2';

    public function getlabel(): string
    {
        return match ($this) {
            self::PARENT => 'Hoofdlocatie',
            self::SECOND => 'Nevenlocatie',

        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PARENT => 'heroicon-o-cpu-chip',
            self::SECOND => 'heroicon-m-check',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::PARENT => 'gray',
            self::SECOND => 'warning',
        };
    }
}
