<x-filament-panels::page>

{{-- BASISBEHEER --}}
<section class="space-y-4">
    <h2 class="text-lg font-semibold text-gray-700">Basisbeheer</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">

        @can('view_any_user')
        <x-dashboard.card
            href="users"
            title="Medewerkers"
            description="Beheer de medewerkers"
            icon="/images/icons/pack/conference_call.svg"
        />
        @endcan

        @if(setting('use_company_locations'))
        @can('view_any_location')
        <x-dashboard.card
            href="locations"
            title="Locaties"
            description="Beheer de locaties van je bedrijf"
            icon="/images/icons/pack/department.svg"
        />
        @endcan
        @endif

        @if(setting('use_company_spaces'))
        @can('view_any_department')
        <x-dashboard.card
            href="departments"
            title="Afdelingen"
            description="Beheer de afdelingen"
            icon="/images/icons/pack/collaboration.svg"
        />
        @endcan
        @endif

        @can('view_any_role')
        <x-dashboard.card
            href="/shield/roles"
            title="Gebruikersrollen"
            description="Rechten en groepen"
            icon="/images/icons/pack/grid.svg"
        />
        @endcan

        <x-dashboard.card
            href="tenant-settings"
            title="Omgeving instellingen"
            description="Bedrijfsinformatie & opties"
            icon="/images/icons/pack/candle_sticks.svg"
        />

    </div>
</section>

{{-- CATEGORIEËN --}}
<section class="space-y-4 pt-8">
    <h2 class="text-lg font-semibold text-gray-700">Structuur & Categorieën</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">

        <x-dashboard.card-list
            title="Categorieën"
            icon="/images/icons/pack/in_transit.svg"
        >
            <li><a href="/ticket-types">Tickets</a></li>
            <li><a href="/relation-types">Relaties</a></li>
            <li><a href="/contact-types">Contactpersonen</a></li>
            <li><a href="/location-types">Locaties</a></li>
        </x-dashboard.card-list>

        <x-dashboard.card-list
            title="Statussen"
            icon="/images/icons/pack/accept_database.svg"
        >
            <li><a href="/project-statuses">Projecten</a></li>
        </x-dashboard.card-list>

        <x-dashboard.card-list
            title="Werkbonnen & Tickets"
            icon="/images/icons/pack/portrait_mode.svg"
        >
            <li><a href="/errors">Werkomschrijvingen</a></li>
            <li><a href="/solutions">Oplossingen</a></li>
            <li><a href="/workorder-activities">Uursoorten</a></li>
        </x-dashboard.card-list>

    </div>
</section>

{{-- LIFTEN MODULE --}}
@if(setting('module_elevators'))
<section class="space-y-4 pt-8">
    <h2 class="text-lg font-semibold text-gray-700">Liften & Roltrappen</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">

        <x-dashboard.card
            href="object-monitoring-codes"
            title="Monitoringscodes"
            description="Foutcodes object monitoring"
            icon="/images/icons/pack/bar_chart.svg"
        />

        <x-dashboard.card
            href="/connection/elevators/modusystem"
            title="Modusystem"
            description="Koppelingsinstellingen"
            icon="/images/connections/elevators/modusystem.png"
        />

        <x-dashboard.card
            href="/connection/elevators/liftinstituut"
            title="Liftinstituut"
            description="Koppelingsinstellingen"
            icon="/images/connections/elevators/liftinstituut-logo-41197.webp"
        />

    </div>
</section>
@endif

</x-filament-panels::page>
