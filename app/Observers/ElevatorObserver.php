<?php

namespace App\Observers;

use App\Models\Elevator;

class ElevatorObserver
{


    public function creating(Elevator $elevator): void
    {
        dd('asd');
       if (auth()->hasUser()) {
           $elevator->company_id    =  Filament::getTenant()->id;
       }
  
    }


    /**
     * Handle the elevator "created" event.
     */
    public function created(Elevator $elevator): void
    {
        //
    }

    /**
     * Handle the elevator "updated" event.
     */
    public function updated(Elevator $elevator): void
    {
        //
    }

    /**
     * Handle the elevator "deleted" event.
     */
    public function deleted(Elevator $elevator): void
    {
        //
    }

    /**
     * Handle the elevator "restored" event.
     */
    public function restored(Elevator $elevator): void
    {
        //
    }

    /**
     * Handle the elevator "force deleted" event.
     */
    public function forceDeleted(Elevator $elevator): void
    {
        //
    }
}
