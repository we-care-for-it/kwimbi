<?php

namespace App\Observers;

use App\Models\ProjectReaction;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;


class ProjectReactionObserver
{
    /**
     * Handle the ProjectReaction "created" event.
     */

     public function creating(ProjectReaction $projectReaction): void
     {
        if (auth()->hasUser()) {
            $projectReaction->company_id    =  Filament::getTenant()->id;
            $projectReaction->user_id       =  Auth::id();
        }
   
     }
     
    public function created(ProjectReaction $projectReaction): void
    {
 
    }

    /**
     * Handle the ProjectReaction "updated" event.
     */
    public function updated(ProjectReaction $projectReaction): void
    {
        //
    }

    /**
     * Handle the ProjectReaction "deleted" event.
     */
    public function deleted(ProjectReaction $projectReaction): void
    {
        //
    }

    /**
     * Handle the ProjectReaction "restored" event.
     */
    public function restored(ProjectReaction $projectReaction): void
    {
        //
    }

    /**
     * Handle the ProjectReaction "force deleted" event.
     */
    public function forceDeleted(ProjectReaction $projectReaction): void
    {
        //
    }
}
