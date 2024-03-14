<?php

namespace App\Http\Livewire\Company\Projects;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Project;
class Show extends Component
{

    public $project;
    public function render()
    {
        return view('livewire.company.projects.show');
    }


    public function mount(Request $request)
    {
        $this->project = Project::findBySlug($request->slug);
        


    }

}
