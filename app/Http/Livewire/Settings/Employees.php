<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;


//Models
 
 
use App\Models\User;
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



class Employees extends Component
{

    use WithPerPagePagination;
    use WithSorting;
    use WithBulkActions;
    use WithCachedRows;
    public $edit_id;
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $keyword;
    public $cntFilters;

    #[Validate('required', message: 'Vul minimaal een naam in')]
    public $name;
    public $data;



    public function render()
    {

        return view('livewire.settings.employees',[
            'items' => $this->rows,
            ]);
 
    }


    
    public $filters = [
        'keyword'   => '', 
 
        
    ];
 
    protected $rules = [
        'name' => 'required',
        
    ];

    
    public function getRowsQueryProperty()
    {
        $query = User::query()->when($this->filters['keyword'], function ($query) {
            $query->where('name', 'like', '%' . $this->filters['keyword'] . '%')
               
 ;
        });
        Session()->put('paymethod_error_filter', json_encode($this->filters));

        return $query->orderBy($this->sortField, $this->sortDirection);
    }


    public function countFilters(){
   
        $this->cntFilters = ( $this->filters['keyword'] ? 1 : 0);
    }


    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function mount(Request $request)
    {
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
 
    $this->edit_id =NULL;
 
}


 
public function save(){
   
    $this->validate();

    if(!$this->edit_id){
        User::create($this->all());
    }else{
        $this->data->update($this->all());
    }
    
 
    $this->reset();
    $this->dispatch('close-crud-modal');
    noty()
    ->layout('bottomRight')
    ->addInfo('Gegevens opgeslagen');
}
 

    public function updatedFilters()
    {
        Session()->put('paymethod_error_filter', json_encode($this->filters));
        $this->countFilters();
    
    }

    public function resetFilters()
    {
        $this->reset('filters');
        session()->pull('paymethod_error_filter', '');
        $this->gotoPage(1);
        return redirect(request()->header('Referer'));

    }

    public function edit($id)
    {
    
        $this->edit_id = $id;
        $this->data = $item = User::where('id', $id)->first();
         $this->name =  $this->data->name;
        
 



    }


    public function delete($id){
        $item= User::find($id);
        $item->delete();  
        $this->dispatch('close-crud-modal');
        noty()
        ->layout('bottomRight')
        ->addInfo('Gegevens verwijderd');
    }

 

}
