<x-filament-panels::page>
   <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
   <div>


  <h1 class="pb-2 text-lg font-medium text-gray-700">Mijn bedrijf</h1>
   <div class="grid grid-cols-4 gap-4 max-xl:grid-cols-3 max-md:grid-cols-2">

@can('view_any_user')
<a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="users">
   <img  src = "/images/icons/pack/conference_call.svg"   class = "max-h-12">
   <div>
      <h2>Medewerkers</h2>
      <p class="text-sm text-gray-600">Beheer de medewerkersn</p>
   </div>
</a>
@endcan

@if(setting('use_company_locations'))
   @can('view_any_location')
   <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="locations">
      <img  src = "/images/icons/pack/department.svg"  class = "max-h-12">
      <div>
         <h2>Locaties</h2>
         <p class="text-sm text-gray-600">Beheer de locaties je bedrijf</p>
      </div>
   </a>
   @endcan
@endif



@if(setting('use_company_spaces'))
   @can('view_any_department')
   <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400" href="departments">
      <img  src = "/images/icons/pack/collaboration.svg"   class = "max-h-12">
      <div>
         <h2>Afdelingen</h2>
         <p class="text-sm text-gray-600">Beheer de afdelingen in je bedrijf</p>
      </div>
   </a>
   @endcan
@endif


@if(setting('use_company_spaces'))
   @can('view_any_space')
   <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400" href="spaces">
      <img  src = "/images/icons/pack/org_unit.svg"   class = "max-h-12">
      <div>
         <h2>Ruimtes</h2>
         <p class="text-sm text-gray-600">Beheer de ruimtes in je bedrijf</p>
      </div>
   </a>
   @endcan
@endif

@can('view_any_role')
<a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400" href="/shield/roles">
   <img  src = "/images/icons/pack/grid.svg"   class = "max-h-12">
   <div>
      <h2>Gebruikersrollen</h2>
      <p class="text-sm text-gray-600">Rechten groepen voor de gebruikers</p>
   </div>
</a>
@endcan

@if(setting('use_vehiclemanagement'))
   @can('view_any_vehicle')
   <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400" href="vehicles">
      <img  src = "/images/icons/pack/candle_sticks.svg"   class = "max-h-12">
      <div>
         <h2>Auto beheer</h2>
         <p class="text-sm text-gray-600">Voertuigenbeheer</p>
      </div>
   </a>
   @endcan
@endif

@if(setting('use_gps_tracker'))
   @can('view_any_vehicle::g::p::s')
   <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400" href="vehicle-g-ps">
      <img  src = "/images/icons/pack/automotive.svg"   class = "max-h-12">
      <div>
         <h2>GPS Modules</h2>
         <p class="text-sm text-gray-600">GPS modules voor voortuigen</p>
      </div>
   </a>
   @endcan
@endif

@if(setting('use_company_warehouses'))
   @can('view_any_warehouse')
   <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400" href="warehouses">
      <img  src = "/images/icons/pack/businessman.svg"   class = "max-h-12">
      <div>
         <h2>Magazijnen</h2>
         <p class="text-sm text-gray-600">Beheer de magazijnen in je bedrijf</p>
      </div>
   </a>
   @endcan
@endif


@can('view_any_warehouse')
<a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400" href="warehouses">
   <img  src = "/images/icons/pack/businessman.svg"   class = "max-h-12">
   <div>
      <h2>Voorraden</h2>
      <p class="text-sm text-gray-600">Beheer de magazijnen in je bedrijf</p>
   </div>
</a>
@endcan






</div>





      <h1 class="pb-2 text-lg font-medium text-gray-700 pt-10">Categorieeen</h1>
      <div class="grid grid-cols-4 gap-4 max-xl:grid-cols-3 max-md:grid-cols-2">



         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="contact-types">
            <img  src = "/images/icons/pack/conference_call.svg"   class = "max-h-12">
            <div>
               <h2>Contactpersonen </h2>
               <p class="text-sm text-gray-600">Contactpersoon  types rechten instellen</p>
            </div>
         </a>


         @can('view_any_relationTypePolicy')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="relation-types">
            <img  src = "/images/icons/pack/conference_call.svg"   class = "max-h-12">
            <div>
               <h2>view_any_relation::type</h2>
               <p class="text-sm text-gray-600">Relatie Categorieeen</p>
            </div>
         </a>
         @endcan



         @can('view_any_location::type')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="location-types">
            <img  src = "/images/icons/pack/conference_call.svg"   class = "max-h-12">
            <div>
               <h2>Locatie categorieeen</h2>
               <p class="text-sm text-gray-600">Locatie Categorieeen</p>
            </div>
         </a>
         @endcan



         @can('view_any_relation::type')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="relation-types">
            <img  src = "/images/icons/pack/conference_call.svg"   class = "max-h-12">
            <div>
               <h2>Relatie categorieeen</h2>
               <p class="text-sm text-gray-600">Locatie Categorieeen</p>
            </div>
         </a>
         @endcan




         @can('view_any_object::type')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="object-types">
            <img  src = "/images/icons/pack/conference_call.svg"   class = "max-h-12">
            <div>
               <h2>Object categorieeen</h2>
               <p class="text-sm text-gray-600">Object Categorieeen</p>
            </div>
         </a>
         @endcan

<!--
         @can('view_any_location::type')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="location-types">
            <img  src = "/images/icons/pack/conference_call.svg"   class = "max-h-12">
            <div>
               <h2>Locatie types</h2>
               <p class="text-sm text-gray-600">Locatie types</p>
            </div>
         </a>
         @endcan -->

</div>





      <h1 class="pb-2 text-lg font-medium text-gray-700 pt-10">Mijn bedrijf</h1>
<div class="grid grid-cols-4 gap-4 max-xl:grid-cols-3 max-md:grid-cols-2">

      <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400" href="my-company">
            <img  src = "/images/icons/pack/candle_sticks.svg"   class = "max-h-12">
            <div>
               <h2>Mijn bedrijf</h2>
               <p class="text-sm text-gray-600">Medewerkers, Rechten, Magazijnen...    </p>
            </div>
         </a>

         @can('view_any_object')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400" href="object-monitoring-codes">
            <img  src = "/images/icons/pack/bar_chart.svg"   class = "max-h-12">
            <div>
               <h2>Monitoringscodes</h2>
               <p class="text-sm text-gray-600">Fout codes voor object monitoring</p>
            </div>
         </a>
         @endcan


         @can('view_any_relation::type')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="custom-fields">
            <img  src = "/images/icons/pack/conference_call.svg"   class = "max-h-12">
            <div>
               <h2>Vrijvelden</h2>
               <p class="text-sm text-gray-600">Wijzig en voeg vrij velden toe </p>
            </div>
         </a>
         @endcan

      </div>





      <h1 class="pb-2 text-lg font-medium text-gray-700 pt-10">Assets</h1>
      <div class="grid grid-cols-4 gap-4 max-xl:grid-cols-3 max-md:grid-cols-2">



      <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400" href="tenant-settings">
            <img  src = "/images/icons/pack/candle_sticks.svg"   class = "max-h-12">
            <div>
               <h2>Portal</h2>
               <p class="text-sm text-gray-600">Huistijl, Modules, Email configuratie</p>
            </div>
         </a>



         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400" href="article-category">
            <img  src = "/images/icons/pack/candle_sticks.svg"   class = "max-h-12">
            <div>
               <h2>Matrieel (nog Geen rechten)</h2>
               <p class="text-sm text-gray-600">Categorieen voor artikelen</p>
            </div>
         </a>
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400" href="article-category">
            <img  src = "/images/icons/pack/candle_sticks.svg"   class = "max-h-12">
            <div>
               <h2>Matrieel statussen (nog Geen rechten)</h2>
               <p class="text-sm text-gray-600">Categorieen voor artikelen</p>
            </div>
         </a>
      </div>
      <h1 class="pb-2 text-lg font-medium text-gray-700 pt-10">Artikelen</h1>
      <div class="grid grid-cols-4 gap-4 max-xl:grid-cols-3 max-md:grid-cols-2">

         @can('view_any_artick')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400" href="article-category">
            <img  src = "/images/icons/pack/candle_sticks.svg"   class = "max-h-12">
            <div>
               <h2>Categorieeen (nog Geen rechten)</h2>
               <p class="text-sm text-gray-600">Categorieen voor artikelen</p>
            </div>
         </a>
         @endcan
      </div>



      <h1 class="pb-2 text-lg font-medium text-gray-700 pt-10">Logboeken</h1>
      <div class="grid grid-cols-4 gap-4 max-xl:grid-cols-3 max-md:grid-cols-2">

      @can('view_any_authentication::log')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href=" authentication-logs">
            <img  src = "/images/icons/pack/webcam.svg"   class = "max-h-12">
            <div>
               <h2>Inlog logboek</h2>
               <p class="text-sm text-gray-600">Bekijk welke gebruiker waneer is ingelogd </p>
            </div>
         </a>

         @endcan



         @can('view_any_authentication::log')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href=" mail-settings">
            <img  src = "/images/icons/pack/webcam.svg"   class = "max-h-12">
            <div>
               <h2>Mail instellingen</h2>
               <p class="text-sm text-gray-600">Configureer de uitgaande mail isntellingen </p>
            </div>
         </a>

         @endcan


      </div>




      <h1 class="pb-2 text-lg font-medium text-gray-700 pt-10">Werkbonnen</h1>
      <div class="grid grid-cols-4 gap-4 max-xl:grid-cols-3 max-md:grid-cols-2">

      @can('view_any_workorder::activitie')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="workorder-activities">
            <img  src = "/images/icons/pack/webcam.svg"   class = "max-h-12">
            <div>
               <h2>Type werkzaamheden</h2>
               <p class="text-sm text-gray-600">Omschrijvingen van de standaard werkzaamheden</p>
            </div>
         </a>

         @endcan
         @can('view_any_solution')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="/solutions">
            <img  src = "/images/icons/pack/webcam.svg"   class = "max-h-12">
            <div>
               <h2>Oplossingen</h2>
               <p class="text-sm text-gray-600">Standaard oplossingen </p>
            </div>
         </a>
         @endcan

         @can('view_any_error')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="/errors">
            <img  src = "/images/icons/pack/webcam.svg"   class = "max-h-12">
            <div>
               <h2>Foutmeldingen</h2>
               <p class="text-sm text-gray-600">Standaard foutmeldingen  </p>
            </div>
         </a>
         @endcan
         @can('view_any_artick')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="workorder-solution">
            <img  src = "/images/icons/pack/biohazard.svg"   class = "max-h-12">
            <div>
               <h2>Storingen (nog Geen rechten)</h2>
               <p class="text-sm text-gray-600">................</p>
            </div>
         </a>
         @endcan
      </div>

NOG RECHTEN CHECKEN


<a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="brands">
            <img  src = "/images/icons/pack/conference_call.svg"   class = "max-h-12">
            <div>
               <h2>Merken</h2>
               <p class="text-sm text-gray-600">Beheer de medewerkersn</p>
            </div>
         </a>
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="models">
            <img  src = "/images/icons/pack/conference_call.svg"   class = "max-h-12">
            <div>
               <h2>Modellen</h2>
               <p class="text-sm text-gray-600">Beheer de medewerkersn</p>
            </div>
         </a>





   </div>
</x-filament-panels::page>
