<?php

namespace App\Http\Livewire\Company\Customers;

use Livewire\Component;
 
use App\Models\Contact;


//Datatable
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;
 


class Contacts extends Component
{

    use WithPerPagePagination;
    use WithSorting;
    use WithBulkActions;
    use WithCachedRows;

    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $keyword;

    public $contacts = [];
    public $debtor_id;

 
 
    public $filters = [
        'keyword'   => '', 
      
    ];


    public function render()
    {
        return view('livewire.company.customers.contacts',[
          
        ]);
    }


      public function mount(){

  $this->contacts =  Contact::query()->where('customer_id',$this->debtor_id)->orderby('name')->get();


  
      }

 

    //Location::where('customer_id', $debtor_id)->get();
}
