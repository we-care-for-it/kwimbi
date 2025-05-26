<x-filament::page>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <div class="space-y-6">
        <input wire:change="search" type="text" wire:model="keyword" placeholder="Zoek naar instellingen..." class="fi-input" />
        <div>
            <div class="grid grid-cols-4 gap-4 max-xl:grid-cols-3 max-md:grid-cols-2">
               @if($results->isNotEmpty())
                  @foreach($results as $setting)
                  <!-- /* @can($setting->permission) -->

                   <a class="content flex   gap-4 p-3 bg-white rounded-lg border border-gray-400  0" href="{{$setting->link}}">
   <img  src = "/images/noimage.png"   class = "max-h-12">
                           <div>
                                 <h2>{{ucfirst($setting->name)}}</h2>
                                 <p class="text-sm text-gray-600">{{ucfirst($setting->description)}}</p>
</div>
                        </a>
                        <!-- @endcan -->
                  @endforeach
                  @else
                  <p class="text-gray-500">Geen instellingen gevonden</p>
               @endif
            </div>
        </div>
</x-filament::page>
