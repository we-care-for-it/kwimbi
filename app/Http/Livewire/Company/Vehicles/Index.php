<?php

namespace App\Http\Livewire\Company\Vehicles;

use App\Models\Vehicle;
use Illuminate\Http\Request;

use Livewire\Component;



//Datatable
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class Index extends Component
{


    use WithPerPagePagination;
    use WithSorting;
    use WithBulkActions;
    use WithCachedRows;

    public $sortField = 'kenteken';
    public $sortDirection = 'desc';
    public $keyword;
    public $cntFilters;



    public function render()
    {
        return view('livewire.company.vehicles.index',[
            'items' => $this->rows
            ]);
    }

    
    public $filters = [
        'keyword'   => '',
    ];



    public function getRowsQueryProperty()
    {
        $query = Vehicle::query()->when($this->filters['keyword'], function ($query) {
            $query->where('kenteken', 'like', '%' . $this->filters['keyword'] . '%');
                // ->Orwhere('address', 'like', '%' . $this->filters['keyword'] . '%')
                // ->Orwhere('place', 'like', '%' . $this->filters['keyword'] . '%')
                 
        });
         
        Session()->put('Supplier_filters', json_encode($this->filters));

        return $query->orderBy($this->sortField, $this->sortDirection);
    }


    public function countFilters(){
   
        $this->cntFilters = 0;
        //( $this->filters['keyword'] ? 1 : 0)+ ( $this->filters['place'] ? 1 : 0);
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
        $item=Supplier::find($id);
        $item->delete();  
        $this->dispatch('close-crud-modal');
        pnotify()->addWarning('Gegevens verwijderd');
    }


}
