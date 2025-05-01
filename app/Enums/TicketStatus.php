<?php
namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
enum TicketStatus: string implements HasLabel {
    case NEW                     = '1';  // Nieuw aangemaakt ticket
    case ACCEPTED_FOR_ASSESSMENT = '2';  // Geaccepteerd voor beoordeling
    case ASSESSED                = '3';  // Beoordeeld door Change Advisory Board
    case APPROVED                = '4';  // Goedgekeurd
    case IN_IMPLEMENTATION       = '5';  // Wordt uitgevoerd
    case IMPLEMENTED             = '6';  // Succesvol geïmplementeerd
    case CLOSED                  = '7';  // Administratief afgerond
    case REJECTED                = '8';  // Afgekeurd
    case IN_PROGRESS             = '9';  // Wordt behandeld
    case PENDING                 = '10'; // Wacht op input
    case ESCALATED               = '11'; // Doorgestuurd naar hogere lijn
    case REQUESTED               = '12'; // Ingediend voor beoordeling

    public function getlabel(): string
    {
        return match ($this) {
            self::NEW => 'Nieuw',
            self::REQUESTED => 'Aangevraagd',
            self::ACCEPTED_FOR_ASSESSMENT => 'Geaccepteerd voor beoordeling',
            self::ASSESSED => 'Beoordeeld',
            self::IN_PROGRESS => 'In behandeling',
            self::PENDING => 'In wachtrij',
            self::ESCALATED => 'Doorgestuurd',
            self::APPROVED => 'Goedgekeurd',
            self::IN_IMPLEMENTATION => 'In uitvoering',
            self::IMPLEMENTED => 'Geïmplementeerd',
            self::CLOSED => 'Gesloten',
            self::REJECTED => 'Afgewezen',
        };
    }
}
