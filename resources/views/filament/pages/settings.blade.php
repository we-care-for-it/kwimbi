<x-filament-panels::page>
   <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
   <div>
      <h1 class="pb-2 text-lg font-medium text-gray-700">Mijn bedrijf</h1>
      <div class="grid grid-cols-4 gap-4 max-xl:grid-cols-3 max-md:grid-cols-2">



         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="contact-types">
            <img  src = "/images/icons/pack/conference_call.svg"   class = "max-h-12">
            <div>
               <h2>Contactpersonen categorieen </h2>
               <p class="text-sm text-gray-600">Contactpersoon  types rechten instellen</p>
            </div>
         </a>


         @can('view_any_relationTypePolicy')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="relation-types">
            <img  src = "/images/icons/pack/conference_call.svg"   class = "max-h-12">
            <div>
               <h2>view_any_relation::type</h2>
               <p class="text-sm text-gray-600">Relatie types</p>
            </div>
         </a>
         @endcan



         @can('view_any_relation::type')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="relation-types">
            <img  src = "/images/icons/pack/conference_call.svg"   class = "max-h-12">
            <div>
               <h2>Relatie types</h2>
               <p class="text-sm text-gray-600">Locatie types</p>
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




         @can('view_any_location::type')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="location-types">
            <img  src = "/images/icons/pack/conference_call.svg"   class = "max-h-12">
            <div>
               <h2>Locatie types</h2>
               <p class="text-sm text-gray-600">Locatie types</p>
            </div>
         </a>
         @endcan



         @can('view_any_object')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400" href="object-monitoring-codes">
            <img  src = "/images/icons/pack/bar_chart.svg"   class = "max-h-12">
            <div>
               <h2>Monitoringscodes</h2>
               <p class="text-sm text-gray-600">Fout codes voor object monitoring</p>
            </div>
         </a>
         @endcan
      </div>
      <h1 class="pb-2 text-lg font-medium text-gray-700 pt-10">Mijn bedrijf</h1>

      <h1 class="pb-2 text-lg font-medium text-gray-700 pt-10">Assets</h1>
      <div class="grid grid-cols-4 gap-4 max-xl:grid-cols-3 max-md:grid-cols-2">

         @can('view_any_object')
         <a class="content flex  py-5  gap-4 p-3 bg-white rounded-lg border border-gray-400" href="object-types">
            <img  src = "/images/icons/pack/candle_sticks.svg"   class = "max-h-12">
            <div>
               <h2>Object types</h2>
               <p class="text-sm text-gray-600">Object types</p>
            </div>
         </a>
         @endcan

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
