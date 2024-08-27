<?php

namespace App\Http\Livewire\System\User;

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
    public $email;
    public $editId;
    public $login_type;

 
 
    

    public $filters = [
        'keyword'   => '', 
        
        
    ];

 

  
    public function render()
    {
        return view('livewire.system.user.index',[
            'items' => $this->rows,
 
            ]);
    }


    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
    ];

    
    public function getRowsQueryProperty()
    {
        $query = User::query()->when($this->filters['keyword'], function ($query) {
            $query->where('name', 'like', '%' . $this->filters['keyword'] . '%')
                ->Orwhere('email', 'like', '%' . $this->filters['keyword'] . '%');
             
        });
        
        Session()->put('address_filter', json_encode($this->filters));

        return $query->orderBy($this->sortField, $this->sortDirection);
    }


    public function countFilters(){
   
    //    $this->cntFilters = ( $this->filters['keyword'] ? 1 : 0)+ ( $this->filters['place'] ? 1 : 0);
    }


    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function mount(Request $request)
    {
    //     if (session()->get('address_filter')) {
    //         $this->filters = json_decode(session()->get('customer_filters'), true);
    //     }else{
    //         Session()->put('address_filter', json_encode($this->filters));
            
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
    $this->email =NULL;
    $this->login_type =NULL;
    


 
}

 
public function save(){
   
$this->validate();
    $data = User::updateOrCreate(
        ['id' =>$this->editId],
        [
            'name' => $this->name,
            'email' => $this->email,
            'login_type' => $this->login_type,
            

            'password' => date('dyihm')

        ]
    );
 

    $this->clear();
    pnotify()->addWarning('Gegevens opgeslagen');
    return redirect(request()->header('Referer'));

}
 
    public function updatedFilters()
    {
        Session()->put('address_filter', json_encode($this->filters));
        $this->countFilters();
    
    }

    public function resetFilters()
    {
        $this->reset('filters');
        session()->pull('address_filter', '');
        $this->gotoPage(1);
        return redirect(request()->header('Referer'));

    }

    public function edit($id)
    {
        $this->editId = $id;

        $item = User::where('id', $id)->first();
        $this->email      = $item->email;
        $this->login_type      = $item->login_type;
        
        $this->name         = $item->name;
      



    }


    public function delete($id){
        $item=User::find($id);
        $item->delete();  
        return redirect(request()->header('Referer'));
    }


}
