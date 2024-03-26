<?php

namespace App\Http\Livewire\Company\Suppliers;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Supplier;


class Show extends Component
{

    public $object = [];
    
    public function render()
    {
        return view('livewire.company.suppliers.show');
    }

    public function mount(Request $request)
    {
        $this->object = Supplier::find($request->slug);    
    }

    protected $rules = [
        'name' => 'required|min:6',
    ];

    public function save()
    {
        $this->validate();
        
        try {
            $this->data->update($this->all());
        } catch (QueryException $e) {
            dd('Ioe fout');
        }

        pnotify()->addWarning('Gegevens opgeslagen');    
         return redirect('/supplier/' .  $this->data->id);
    }
        
}
