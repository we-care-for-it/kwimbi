<?php

namespace App\Http\Livewire\Company\Locations;

use Livewire\Component;
use App\Models\Location;


use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;






class Index extends Component
{


    public $filters  =
    [
        'status_id'                    => '',
        'keyword'               => '',



    ];

    public $page_number = 0;
public $cntFilters;
public $sortField = 'id';
public $sortDirection = 'desc';



use WithPerPagePagination;
use WithSorting;
use WithBulkActions;
use WithCachedRows;

    public function render()
    {
        return view('livewire.company.locations.index', [
            'items' => $this->rows,
        ]);
    }





    public function getRowsQueryProperty()
    {

        $query = Location::orderby('customer_id', 'DESC')

         ->when($this->filters['keyword'], function ($query) {
             $query->where('name','like', '%' . $this->filters['keyword'] . '%')
             ->orwhere('place', 'like', '%' . $this->filters['keyword'] . '%')
                 // ->orwhere('name', 'like', '%' . $this->filters['keyword'] . '%')
                  ->orwhere('address', 'like', '%' . $this->filters['keyword'] . '%')
                  ->orwhere('place', 'like', '%' . $this->filters['keyword'] . '%')
                  ->orwhere('id', 'like', '%' . $this->filters['keyword'] . '%');;
         });






        return $query;
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function clearFilters()
    {
        $this->filters['keyword'] = NULL;
          noty()  ->layout('bottomRight')->addInfo('Filters zijn verwijderd');
    }

}
