<?php
namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum QuoteStatus: string implements HasLabel {
    case CONCEPT        = '1';
    case VERZONDEN      = '2';
    case IN_BEHANDELING = 'i3';
    case GEACCEPTEERD   = '4';
    case AFGEWEZEN      = '5';
    case VERVALLEN      = '6';
    case OMGEZET        = '7';

    public function getlabel(): string
    {
        return match ($this) {
            self::CONCEPT => 'Concept',
            self::VERZONDEN => 'Verzonden',
            self::IN_BEHANDELING => 'In behandeling',
            self::GEACCEPTEERD => 'Geaccepteerd',
            self::AFGEWEZEN => 'Afgewezen',
            self::VERVALLEN => 'Vervallen',
            self::OMGEZET => 'Omgezet naar opdracht',

        };
    }

}
