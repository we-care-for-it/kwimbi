<?php

namespace App\Http\Livewire\Company\Projects;
use App\Models\Project;

//Datatable
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

use Livewire\Component;
use App\Models\Projects;
use App\Models\Statuses;

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
                'status_id'     => '',
    ];


    public function render()
    {
        return view('livewire.company.projects.index',
        [
           'items' => $this->rows,
           'statuses' => Statuses::where('module_id',1)->get(),

         ]
    );
    }

    public function getRowsQueryProperty()
    {
        $query = Project::query()->when($this->filters['keyword'], function ($query) {
            $query->where('name', 'like', '%' . $this->filters['keyword'] . '%');
               // ->Orwhere('address', 'like', '%' . $this->filters['keyword'] . '%')
               // ->Orwhere('place', 'like', '%' . $this->filters['keyword'] . '%');

        });

        // ->when($this->filters['status_id'], function ($query) {
        //     $query->whereIn('status_id', $this->filters['status_id']);
        //
        // })
        ;
         Session()->put('customer_filters', json_encode($this->filters));

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



}
