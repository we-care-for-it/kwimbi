<?php

namespace App\Observers;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Filament\Facades\Filament;

class CustomerObserver
{
    /**
     * Handle the Customers "created" event.
     */

     public function creating(Customer $customer): void
     {
        dd('dd');
        if (auth()->hasUser()) {
            $customers->company_id    =  Filament::getTenant()->id;
            $customers->user_id       =  Auth::id();
        }
     }


    public function created(Customer $customer): void
    {
        //
    }

    /**
     * Handle the Customers "updated" event.
     */
    public function updated(Customer $customer): void
    {
        //
    }

    /**
     * Handle the Customers "deleted" event.
     */
    public function deleted(Customer $customer): void
    {
        //
    }

    /**
     * Handle the Customers "restored" event.
     */
    public function restored(Customer $customer): void
    {
        //
    }

    /**
     * Handle the Customers "force deleted" event.
     */
    public function forceDeleted(Customers $customers): void
    {
        //
    }
}
