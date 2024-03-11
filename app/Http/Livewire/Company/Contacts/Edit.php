<?php
namespace App\Http\Livewire\Company\Contacts;

use Livewire\Component;

use App\Models\Contact;
use App\Models\Customer;

class Edit extends Component
{

    public $data;

    public $name;
    public $phonenumber;
    public $customer_id;
    public $email;
    public $function;
    public $edit_id;

    protected $rules = ['name' => 'required', ];

    public function save()
    {

        $this->validate();

        $this->data->update($this->all());

        pnotify()->addWarning('Gegevens opgeslagen');

        $customer = Customer::where('id', $this->data->customer_id)->first();
        return redirect('/customer/' . $customer->slug);
        
    }

    public function mount($id)
    {
        $this->data = Contact::findOrFail($id);
        $this->edit_id      = $id;
        $this->name         = $this->data->name;
        $this->email        = $this->data->email;
        $this->phonenumber  = $this->data->phonenumber;
        $this->function     = $this->data->function;
        $this->customer_id  = $this->data->customer_id;
    }

    public function render()
    {
        return view('livewire.company.contacts.edit');
    }

}

