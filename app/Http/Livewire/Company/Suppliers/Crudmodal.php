<?php

namespace App\Http\Livewire\Company\Suppliers;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

//Models
use App\Models\Supplier;

class Crudmodal extends Component
{

    public $edit_id;
    public $data;
    public $object;

    protected $rules = [
        'data.name' => 'required|min:6',
    ];

    public function render()
    {
        return view('livewire.company.suppliers.crudmodal');
    }


    public function mount($object)
    {
        if($object){ $this->data = $object->toArray(); }else{ $this->data = []; } 
    }

    public function save(){

    $this->validate();

    if (array_key_exists('id', $this->data)) {
        try {
            $this->object->update($this->data);
        } catch (QueryException $e) {
            pnotify()->addWarning('Er is een fout opgetreden bij het opslaan. Probeer het later opnieuw');  
        }
    }else{
        try {
            Supplier::create($this->data);
        }catch (QueryException $e) {
            pnotify()->addWarning('Er is een fout opgetreden bij het opslaan. Probeer het later opnieuw');  
        }
   }
 
   
 

    $this->dispatch('close-crud-modal');
    return redirect(request()->header('Referer'));
 

}



public function checkZipcode()
{


    $this->data['zipcode'] = strtoupper(trim(preg_replace("/\s+/", "", $this->data['zipcode'])));
    if (strlen($this->data['zipcode']) == 6) {
        $response = Http::get('https://api.pro6pp.nl/v1/autocomplete?auth_key=okw7jAaDun87tKnD&nl_sixpp=' . $this->data['zipcode']);
        $data = $response->json();

        if ($data['results']) {
            $this->data['place'] = $data['results'][0]['city'];
            $this->data['address'] = $data['results'][0]['street'];
        } else {
            $this->data['place'] = "";
            $this->data['address'] = "";
            pnotify()->addWarning('Geen gegevens gevonden met deze postcode');
        }
    }
}

}