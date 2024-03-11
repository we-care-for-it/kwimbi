<?php
namespace App\Http\Livewire\Company\Customers\Contact;
use Illuminate\Http\Request;

use App\Livewire\Forms\ContatForm;


use Livewire\Component;
use App\Models\Customer;
use App\Models\Contact;



class UpdatePost extends Component
{
    public PostForm $form;
 
    public function mount(Post $post)
    {
        $this->form->setPost($post);
    }
 
    public function save()
    {
        $this->form->update();
 
        return $this->redirect('/posts');
    }
 
    public function render()
    {
        return view('livewire.create-post');
    }
}


class Create extends Component

{

    public $customer;

    public $name;
    public $phonenumber;
    public $customer_id;
    public $email;
    public $function;
    public $edit_id;

    public function render()
    {
        return view('livewire.company.customers.contact.create');
    }

    public function mount(Request $request)
    {
        $this->customer = Customer::where('id', $request->customer_id)
            ->first();;
    }

    protected $rules = ['name' => 'required', ];

    public function save()
    {

        $this->validate();

        Contact::create($this->all());

        pnotify()
            ->addWarning('Gegevens opgeslagen');
        return redirect('/customer/' . $this
            ->customer
            ->slug);
        $this->reset();

    }

}

