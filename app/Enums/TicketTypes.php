<?php
namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
enum TicketTypes: string implements HasLabel {

    case CHANGEREQUEST = '1';
    case INCIDENT      = '2';

    public function getlabel(): string
    {
        return match ($this) {
            self::CHANGEREQUEST => 'Aanpassing',
            self::INCIDENT => 'Incident',
        };
    }
}
