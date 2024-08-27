<?php

namespace App\Http\Livewire\Company\Customers;

use Livewire\Component;




//Models
use App\Models\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;

//Datatable
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

use Illuminate\Support\Facades\Http;

class Index extends Component
{


    use WithPerPagePagination;
    use WithSorting;
    use WithBulkActions;
    use WithCachedRows;

    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $keyword;
    public $cntFilters;

    public $name;
    public $phonenumber;
    public $address;
    public $zipcode;
    public $place;
    public $emailaddress;
    public $edit_id;
    public $customer;

    public $filters = [
        'keyword'   => '', 
        'place'     => '', 
    ];

 


    public function render()
    {
        return view('livewire.company.customers.index',[
            'items' => $this->rows
            ]);
    }


    protected $rules = [
        'name' => 'required|min:6',
    ];

    
    public function getRowsQueryProperty()
    {
        $query = Customer::query()->when($this->filters['keyword'], function ($query) {
            $query->where('name', 'like', '%' . $this->filters['keyword'] . '%')
                ->Orwhere('address', 'like', '%' . $this->filters['keyword'] . '%');
               
                 
        });
        
        Session()->put('customer_filters', json_encode($this->filters));

        return $query->orderBy($this->sortField, $this->sortDirection);
    }



    public function countFilters(){
        $this->cntFilters = ($this->filters['keyword'] ? 1 : 0) ;
      }
    


    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function mount(Request $request)
    {
       if (session()->get('customer_filters')) {
              $this->filters = json_decode(session()->get('customer_filters'), true);
         }else{
             Session()->put('customer_filters', json_encode($this->filters));
            
     }
    $this->countFilters();
    }


public function sortBy($field)
{
    if ($this->sortField === $field) {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    } else {
        $this->sortDirection = 'asc';
    }

    $this->sortField = $field;
}

public function clear()
{
    $this->name =NULL;
    $this->address =NULL;
    $this->zipcode =NULL;
    $this->place =NULL;;
    $this->emailaddress =NULL;
    $this->phonenumber =NULL;
    $this->edit_id;
 
}

 
public function save(){
   
$this->validate();
    $data = Customer::updateOrCreate(
        ['id' =>$this->edit_id],
        [
            'name' => $this->name,
            'place' => $this->place,
            'zipcode' => $this->zipcode,
            'name' => $this->name,
            'address' => $this->address,
            'emailaddress' => $this->emailaddress,
            'phonenumber' => $this->phonenumber,
            
        ]
    );
 
    $this->dispatch('close-crud-modal');
    $this->clear();
 
        
    pnotify()->addWarning('Gegevens opgeslagen');

}

    //Postcode check
    public function checkZipcode()
    {
        $this->zipcode = strtoupper(trim(preg_replace("/\s+/", "", $this->zipcode)));
        if (strlen($this->zipcode) == 6) {
            $response = Http::get('https://api.pro6pp.nl/v1/autocomplete?auth_key=okw7jAaDun87tKnD&nl_sixpp=' . $this->zipcode);
            $data = $response->json();

            if ($data['results']) {
                $this->place = $data['results'][0]['city'];
                $this->address = $data['results'][0]['street'];
            } else {
                $this->place = "";
                $this->address = "";
                pnotify()->addWarning('Geen gegevens gevonden met deze postcode');
            }
        }
    }

    public function updatedFilters()
    {
        Session()->put('address_filter5', json_encode($this->filters));
        $this->countFilters();
    
    }

    public function resetFilters()
    {
        $this->reset('filters');
        session()->pull('customer_filters', '');
        $this->gotoPage(1);
        return redirect(request()->header('Referer'));

    }

    public function edit($id)
    {
        $this->edit_id = $id;

        $item = Customer::where('id', $id)->first();
        $this->address      = $item->address;
        $this->zipcode      = $item->zipcode;
        $this->place        = $item->place;
        $this->name         = $item->name;
        $this->place        = $item->place;
        $this->emailaddress = $item->emailaddress;
        $this->phonenumber  = $item->phonenumber;
        $this->function  = $item->function;
    }


    public function delete($id){
        $item=Customer::find($id);
        $this->clear();
        $item->delete();  
        $this->dispatch('close-crud-modal');
        pnotify()->addWarning('Gegevens verwijderd');
    }


}
