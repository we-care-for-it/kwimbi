<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Supplier;

class SupplierForm extends Form
{

    public ?Supplier $supplier;
 

    #[Validate('required|min:5')]
    public $name = '';
 
 
    public function setSupplier(Supplier $supplier)
    {
        $this->name = $supplier->name;
 
    
    }


    public function store()
    {
        $this->validate();
 
        Supplier::create($this->only(['name']));
    }
 
    public function update()
    {
        $this->supplier->update(
            $this->all()
        );
    }


}
