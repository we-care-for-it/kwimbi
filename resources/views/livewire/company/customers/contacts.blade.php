<div  >
   
   @if(count($contacts))
 

   <x-table>
      <x-slot name="head">
         <x-table.heading>Naam</x-table.heading>

         <x-table.heading>Functie</x-table.heading>
         <x-table.heading>Telefoonnummer</x-table.heading>
         <x-table.heading>Emailadres</x-table.heading>
         <x-table.heading></x-table.heading>

      </x-slot>
      <x-slot name="body">
         @foreach ($contacts as $contact)
         <x-table.row wire:key="row-{{ $contact->id }}">

            <x-table.cell>
               {{$contact->name}}
            </x-table.cell>

            <x-table.cell>
               @if($contact?->function) <small>{{$contact?->function}}</small> @endif
            </x-table.cell>

            <x-table.cell>
               @if($contact?->phonenumber)
               <a class="pb-2" href="tel:{{$contact?->phonenumber}}"> <i class="fa-solid fa-phone"></i>
                  {{$contact?->phonenumber}}</a><br>
               @endif

            </x-table.cell>

            <x-table.cell>
               @if($contact?->email)
               <a href="mailto:{{$contact?->email}}"> <i class="fa-solid fa-envelope"></i> {{$contact?->email}}</a>
               @endif
            </x-table.cell>

            <x-table.cell>

               <div style="float: right">
                  <a href="/contact/edit/{{$contact->id}}">
                     <button style="float: right"
                     class="btn btn-ghost-warning text-warning btn-icon btn-sm rounded-circle"                                  >
                     <i class="bi bi-pencil"></i>
                     </a>
               </div>
            </x-table.cell>

         </x-table.row>
         @endforeach
         </x-slot>
                        </x-table>

@else
<div class="flex justify-center items-center">
   <div>
      <center>
         <h4>Geen contactpersonen gevonden</h4>
         Er zijn geen contactpersonen aangemaakt bij deze klantrelatie.
         <br><br>
         <a href="/customer/contact/{{ $debtor_id }}/create">
            <button class="btn btn-soft-success   btn-sm">
               Aanmaken
            </button></a>

   </div>
</div>
@endif


</div> 
   