<?php

namespace App\Http\Livewire\Company\Contacts;

use Livewire\Component;
use App\Livewire\Forms\ContactForm;
class UpdateContact extends Component
{


    public ContactForm $form;
 
    public function mount(Contact $contact)
    {
        $this->form->setContact($contact);
    }
 
    public function save()
    {
        $this->form->update();
 
        return $this->redirect('/pocontactsts');
    }
 
    public function render()
    {
        return view('livewire.create-post');
    }

 





    
}
