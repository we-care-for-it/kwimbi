<?php

namespace App\Http\Livewire\Company\Customers;

use Livewire\Component;
 
use App\Models\Location;


//Datatable
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;
 


class Invoices extends Component
{

    use WithPerPagePagination;
    use WithSorting;
    use WithBulkActions;
    use WithCachedRows;

    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $keyword;

    public $locations = [];
    public $debtor_id;

 
 
    public $filters = [
        'keyword'   => '', 
      
    ];


    public function render()
    {
        return view('livewire.company.customers.locations',[
          
        ]);
    }


      public function mount(){

  $this->locations =  Location::query()->where('customer_id',$this->debtor_id)->get();


  
      }

 

    //Location::where('customer_id', $debtor_id)->get();
}
