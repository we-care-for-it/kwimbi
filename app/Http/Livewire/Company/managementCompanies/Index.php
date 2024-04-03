<?php

namespace App\Http\Livewire\Company\ManagementCompanies;

use Livewire\Component;




//Models
use App\Models\managementCompany;

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

    public $sortField = 'name';
    public $sortDirection = 'desc';
    public $keyword;
    public $cntFilters;

    public $name;
    public $phonenumber;
    public $address;
    public $zipcode;
    public $place;
    public $emailaddress;
    public $editId;
    public $managementcompany;
    public $edit_id;

 
 
    public $data = [];


    public $filters = [
        'keyword'   => '', 
        'place'     => '', 
    ];

 


    public function render()
    {
        return view('livewire.company.managementCompanies.index',[
            'items' => $this->rows
            ]);
    }


    protected $rules = [
        'data.name' => 'required|min:6',
    ];

    
    public function getRowsQueryProperty()
    {
        $query = managementCompany::query()->when($this->filters['keyword'], function ($query) {
            $query->where('name', 'like', '%' . $this->filters['keyword'] . '%')
                ->Orwhere('address', 'like', '%' . $this->filters['keyword'] . '%')
                ->Orwhere('place', 'like', '%' . $this->filters['keyword'] . '%');
                 
        })
        ->when($this->filters['place'], function ($query) {
            $query->whereIn('place', $this->filters['place']);
                
        });
        Session()->put('managementCompany_filters', json_encode($this->filters));

        return $query->orderBy($this->sortField, $this->sortDirection);
    }


    public function countFilters(){
   
        $this->cntFilters = ( $this->filters['keyword'] ? 1 : 0)+ ( $this->filters['place'] ? 1 : 0);
    }


    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function mount(Request $request)
    {
    //     if (session()->get('Supplier_filters')) {
    //         $this->filters = json_decode(session()->get('Supplier_filters'), true);
    //     }else{
    //         Session()->put('Supplier_filters', json_encode($this->filters));
            
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

 
    public function updatedFilters()
    {
        Session()->put('address_filter5', json_encode($this->filters));
        $this->countFilters();
    
    }

    public function resetFilters()
    {
        $this->reset('filters');
        session()->pull('Supplier_filters', '');
        $this->gotoPage(1);
        return redirect(request()->header('Referer'));

    }
 


    public function delete($id){
        $item=managementCompany::find($id);
        $item->delete();  
        $this->dispatch('close-crud-modal');
        pnotify()->addWarning('Gegevens verwijderd');
    }


}
