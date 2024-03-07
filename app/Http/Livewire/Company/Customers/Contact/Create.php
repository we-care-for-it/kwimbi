<?php

namespace App\Http\Livewire\Company\Customers\Contact;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Contact;
class Create extends Component



{


    public $customer;

    public $name;
    public $phonenumber;
    public $customer_id;
    public $emailaddress;
    public $function;
    public $edit_id;
 
    public function render()
    {
        return view('livewire.company.customers.contact.create');
        
    }

    public function mount(Request $request)
    {
        $this->customer = Customer::where('id', $request->customer_id)->first();;
    }

    protected $rules = [
        'name' => 'required',
    ];



    public function clear()
{
    $this->name =NULL;
    $this->emailaddress =NULL;
    $this->phonenumber =NULL;
    
    $this->customer_id=NULL;
 
    $this->supplier_id=NULL;
    $this->function = NULL;


}
 
public function save(){
   
    $this->validate();
        $data = Contact::updateOrCreate(
            ['id' =>$this->edit_id],
            [
                'name' => $this->name,
                'email' => $this->emailaddress,
                'phonenumber' => $this->phonenumber,
                'customer_id' =>  $this->customer->id,
                'function' => $this->function,
     
    
    
            ]
        );
     
    
        $this->clear();
        pnotify()->addWarning('Gegevens opgeslagen');
        return redirect('/customer/' .  $this->customer->slug );
 
   
    
    }





}