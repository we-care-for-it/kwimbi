<?php

namespace App\Http\Livewire\Company\Contacts;

use Livewire\Component;




//Models
use App\Models\Supplier;
use App\Models\maintenanceCompany;
use App\Models\inspectionCompany;
use App\Models\managementCompany;
use App\Models\Customer;
use App\Models\Contact;

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
    public $customer_id;
    public $emailaddress;
    public $edit_id;
    public $customer;

    public $management_id;
    public $inspection_company_id;
    public $maintency_company_id;
    public $supplier_id;
    public $function;

    public $filters = [
        'keyword'   => '', 
        'supplier_id'   => '', 
        'maintency_company_id'   => '', 
        'inspection_company_id'   => '', 
        'management_id'   => '', 
        'customer_id'     => '', 
    
    ];

 


    public function render()
    {


        return view('livewire.company.contacts.index',[
            'items'                 => $this->rows,
            'maintenance_companies'  => maintenanceCompany::get(),
            'suppliers'  => Supplier::get(),
            'inspection_companies'  => inspectionCompany::get(),
            'management_companies'  => managementCompany::get(),
            'customers'  => Customer::get(),
            ]);
    }


    protected $rules = [
        'name' => 'required|min:6',
    ];

    
    public function getRowsQueryProperty()
    {
        $query = Contact::query()->when($this->filters['keyword'], function ($query) {
            $query->where('name', 'like', '%' . $this->filters['keyword'] . '%')
                ->Orwhere('email', 'like', '%' . $this->filters['keyword'] . '%')
                ->Orwhere('phonenumber', 'like', '%' . $this->filters['keyword'] . '%');
               
        })
        ->when($this->filters['maintency_company_id'], function ($query) {
            $query->whereIn('maintency_company_id', $this->filters['maintency_company_id']);
                
        })

        ->when($this->filters['customer_id'], function ($query) {
            $query->whereIn('customer_id', $this->filters['customer_id']);
                
        })

        ->when($this->filters['supplier_id'], function ($query) {
            $query->whereIn('supplier_id', $this->filters['supplier_id']);
                
        })

        ->when($this->filters['inspection_company_id'], function ($query) {
            $query->whereIn('inspection_company_id', $this->filters['inspection_company_id']);
                
        })
        ->when($this->filters['management_id'], function ($query) {
            $query->whereIn('management_id', $this->filters['management_id']);
                
        });



        Session()->put('customer_filters', json_encode($this->filters));

        return $query->orderBy($this->sortField, $this->sortDirection);
    }


    public function countFilters(){
   



        $this->cntFilters = ( $this->filters['keyword'] ? 1 : 0)
        + ( $this->filters['customer_id'] ? 1 : 0)
        + ( $this->filters['maintency_company_id'] ? 1 : 0)
        + ( $this->filters['inspection_company_id'] ? 1 : 0)
        + ( $this->filters['management_id'] ? 1 : 0)
        + ( $this->filters['supplier_id'] ? 1 : 0);
    }


    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function mount(Request $request)
    {
    //     if (session()->get('customer_filters')) {
    //         $this->filters = json_decode(session()->get('customer_filters'), true);
    //     }else{
    //         Session()->put('customer_filters', json_encode($this->filters));
            
    // }
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
    $this->emailaddress =NULL;
    $this->phonenumber =NULL;
    $this->management_id=NULL;
    $this->inspection_company_id=NULL;
    $this->maintency_company_id=NULL;
    $this->supplier_id=NULL;
    $this->function = NULL;


}

 
public function save(){
   
$this->validate();
    $data = Contact::updateOrCreate(
        ['id' =>$this->edit_id],
        [
            'name' => $this->name,
            'email' => $this->emailaddress,
            'phonenumber' => $this->phonenumber,
            'management_id' => $this->management_id,
            'inspection_company_id' => $this->inspection_company_id,
            'maintency_company_id' => $this->maintency_company_id,
            'supplier_id' => $this->supplier_id,
            'customer_id' => $this->customer_id,
            'function' => $this->function,
 


        ]
    );
 

    $this->clear();
    $this->dispatch('close-crud-modal');
    pnotify()->addWarning('Gegevens opgeslagen');

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

        $item = Contact::where('id', $id)->first();
        $this->name                     =   $item->name;
        $this->emailaddress             =   $item->email;
        $this->phonenumber              =   $item->phonenumber;
        $this->management_id            =   $item->management_id;
        $this->inspection_company_id    =   $item->inspection_company_id;
        $this->maintency_company_id     =   $item->maintency_company_id;
        $this->supplier_id              =   $item->supplier_id;
        $this->function              =   $item->function;
 
    }


    public function delete($id){
        $item=Contact::find($id);
        $item->delete();  
        $this->dispatch('close-crud-modal');
        pnotify()->addWarning('Gegevens verwijderd');
    }


}
