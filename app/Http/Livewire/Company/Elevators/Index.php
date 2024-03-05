<?php
namespace App\Http\Livewire\Company\Elevators;

use Livewire\Component;
use App\Models\Elevator;
use App\Models\Customer;
use App\Models\Management;
use App\Models\Supplier;
use App\Models\Location;

use App\Models\managementCompany;



use App\Models\Auth;
use App\Models\inspectionCompany;

use App\Models\maintenanceCompany;




//Exports
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ElevatorExport;

use App\Http\Livewire\DataTable\WithSorting;

use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use Illuminate\Database\Eloquent\Builder;


use Symfony\Component\HttpFoundation\Session\Session;
use DB;
use Bugsnag;

class index extends Component
{
    use WithPerPagePagination, WithSorting, WithBulkActions;
    public $description;
    public $customer_id;
    public $construction_year;
    public $nobo_no;
    public $unit_no;
    public $manufacture;
    public $maintenance_company;
    public $check_date;
    public $check_date_valid;
    public $remark;
    public $showAddModal;
    public $edit_id;

  
    public $supplier_id;
    public $address_id;
    public $inspection_company_id;
    public $maintenance_company_id;
    public $stopping_places;
    public $carrying_capacity;
    public $energy_label;
    public $stretcher_elevator;
    public $fire_elevator;
    public $name;
    public $speakconnection;
    public $object_type_id;
    public $status_id;
    public $location_id;

    public $locations_relation = [];

 





    public $countdocument = 0;
    public $insertMode = false;

    //Datatables
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $cntFilters;


    public $selectPage = false;
      public $selectAll = false;
      public $selected = [];


    public $filters = [
      'search' => '',
      'nobo_no' => '',
      'place' => '',
      'install_no' => '',
      'inspection_company_id' =>  [],
      'maintenance_company_id' => [],
      'management_id' => [],
      'customer_id' => [],

      

    ];

    protected $queryString = [];

    // public function updated()
    // {
    //     $this->gotoPage(1);
    // }



        public function create()
        {
          //  $this->useCachedRows();


        }


    public function mount()
    {

        $this->status_id = 1;
       if (session()
            ->get('elevator_relation_search_filters'))
          {
            $this->filters = json_decode(session()->get('elevator_relation_search_filters'), true);

           }


      
           $this->countFilters();

    }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc' : 'asc';

        $this->sortField = $field;
    }

    public function resetFilters()
    {
        $this->reset('filters');

        session()->pull('elevator_relation_search_filters', '');
       //  $this->gotoPage(1);

        pnotify()->addSuccess('Alle filters zijn verwijderd');
 return redirect(request()->header('Referer'));

    }



    function count_($array) {
        return is_array($array) ? count($array) : 0;
    }
    public function render()
    {

     
        
        return view('livewire.company.elevators.index', [
        'elevators' =>  $this->rows,
        'customers'  => Customer::orderBy('name', 'asc')->get(),
        'managements' => managementCompany::orderBy('name', 'asc')->get() ,
        'inspectionCompanys' => inspectionCompany::orderBy('name', 'asc')->get() ,
        'suppliers' => Supplier::orderBy('name', 'asc')->get() ,
        'maintenanceCompanys' => maintenanceCompany::orderBy('name', 'asc')->get() ,
        'locations' => Location::orderBy('name', 'asc')->get() ,
       
       ]);
   
    }

    public function search_loctions_by_relation() {
 
        
        $this->locations_relation =  Location::orderBy('name', 'asc')->get();
 
    }

 public function updatedFilters()
     {
   //   
   //

//   $this->elevators = [];
    Session()->put('elevator_relation_search_filters', json_encode($this->filters));
    $this->countFilters();

   //
   //
    }


  public function countFilters(){
    $this->cntFilters = ($this->filters['search'] ? 1 : 0) +($this->filters['place'] ? 1 : 0) + ($this->filters['management_id'] ? 1 : 0) + ($this->filters['maintenance_company_id'] ? 1 : 0)  + ($this->filters['inspection_company_id'] ? 1 : 0)   + ($this->filters['customer_id'] ? 1 : 0) ;
    
 
  }

  public function updatedSelectPage($value)
      {
          if ($value) {
              return $this->selectPageRows();
          }

          $this->selectAll = false;
          $this->selected = [];
      }

      public function updatedSelected()
      {
          $this->selectAll = false;
          $this->selectPage = false;
      }
      public function selectAllFromDropdown()
      {
          $this->selectAll = true;
          $this->selectPage = true;
      }

      public function selectPageRows()
      {
          $this->selected = $this->rows->pluck('id')->map(fn($id) => (string) $id);
      }

      public function selectAll()
      {
          $this->selectAll = true;
          $this->selectPage = true;
      }
  public function export($type)
     {
         if ($type == 'pdf') {
             $type = \Maatwebsite\Excel\Excel::DOMPDF;
             $extention = ".pdf";
         } elseif ($type == 'csv') {
             $type = \Maatwebsite\Excel\Excel::CSV;
             $extention = ".csv";
         } elseif ($type == 'xlsx') {
             $type = \Maatwebsite\Excel\Excel::XLSX;
             $extention = ".xlsx";
         } elseif ($type == 'html') {
             $type = \Maatwebsite\Excel\Excel::HTML;
             $extention = ".html";
         }

         $filename = "Liften Export " . $extention;
         return (new ElevatorExport())
             ->forSelected($this->selected)
             // ->forPriority($priority)
             // ->forStatus($this->filter_status_id)
             ->download($filename, $type);
     }

     public function getRowsQueryProperty()
        {
 
                    $query = Elevator::when($this->filters['place'], function ($query)
                   {
                     $query->whereHas('address', function ($query)
                     {
                          $query->whereIn('place', $this->filters['place']);
                      });
                  }) ->when($this->filters['customer_id'], function ($query)
                 {
                               $query->whereHas('address', function ($query)
                             {

                                $query->whereIn('customer_id', $this->filters['customer_id']);
                               });

              })  ->when($this->filters['management_id'], function ($query)
              {
                            $query->whereHas('address', function ($query)
                          {

                             $query->whereIn('management_id', $this->filters['management_id']);
                            });

           })    
                 ->when($this->filters['search'], function ($query)
                     {
                         $query->whereHas('address', function ($query)
                         {
                             $query->where('address', 'like', '%' . $this->filters['search'] . '%')
                                 ->orwhere('place', 'like', '%' . $this->filters['search'] . '%')
                                 ->orwhere('name', 'like', '%' . $this->filters['search'] . '%')
                                 ->orwhere('unit_no', 'like', '%' . $this->filters['search'] . '%')
                                 ->orwhere('nobo_no', 'like', '%' . $this->filters['search'] . '%');
                         });;
                         //  ->OrWhere('description', );


                //         //
                //
                 });




            return $this->applySorting($query);
        }

        public function getRowsProperty()
        {
            // return $this->cache(function () {
                return $this->applyPagination($this->rowsQuery);
            // });

            
    

        }


        public function resetPageAfterSearch(){
 
          $this->resetPage();
             // persist to database here
         }

         public function clear(){

         }
     


         public function save(){


            $elevator = [
                'name' => $this->name,
                'stretcher_elevator' => $this->stretcher_elevator,
                'fire_elevator' => $this->fire_elevator,
                'energy_label' => $this->energy_label,
                'speakconnection' => $this->speakconnection,
                'stopping_places' => $this->stopping_places,
                'nobo_no' => $this->nobo_no,
                'unit_no' => $this->unit_no,
                'object_type_id' => $this->object_type_id,
                'status_id' => $this->status_id,
                'maintenance_company_id' => $this->maintenance_company_id,
                'construction_year' => $this->construction_year,
                'inspection_company_id' =>$this->inspection_company_id,
                'customer_id' =>$this->customer_id,
                'address_id' =>$this->location_id,
            ];
             

 
    
            $insert_elevator = Elevator::create($elevator); // don't forget to fill $fillable in Model
    
            pnotify()->addSuccess('Lift toegevoegd');
 
    
            
    
            return redirect('/objects/' . $insert_elevator->id );
         }
     

        
}
