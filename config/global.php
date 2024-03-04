<?php

//Gebruik global config file

//  @foreach (Config::get('global.ticket_types')  as $key => $value))
//  {{$key}}     {{$value}}
//  @endforeach


return [

    'upload_incident_types' =>
        [
            '1' => 'Servicebon',
            '2' => 'Offerte',
            '3' => 'Storingsmelding',
            '4' => 'Bevestiging storing/ afsluiting ',
            '5' => 'Onderhoud periodiek/ storing',
            '6' => 'Site Servey ',
            '7' => 'Opdrachtbon',
            '8' => 'Algemeen bestand',
        ],

    'upload_elevator_types' =>
        [
            '1' => 'Geen ',
            '2' => 'Overige ',
            '3' => 'Opdrachtbon ',
            '4' => 'Offerte ',
            '5' => 'Comunicaties ',
            '6' => 'Site Servey ',
            '7' => 'Servicebon ',
            '8' => 'Algemeen bestand',
        ],

    'ticket_types' =>
        [
            '1' => 'Vraag',
            '2' => 'Incident',
            '3' => 'Probleem',
            '4' => 'toekomstig verzoek',
        ],

    'ticket_sources' =>
        [
            '1' => 'Web',
            '2' => 'Telefoon',
            '2' => 'E-Mail',
        ],

    'priorities' =>
        [
            '1' => 'Hoog',
            '2' => 'Gemiddeld',
            '3' => 'Laag',
        ],

    ];
