<?php

namespace App\Http\Livewire\Knowledgebase\Categories;

use Livewire\Component;
use App\Models\knowledgebaseArticles;
use App\Models\knowledgebaseCategories;
use Illuminate\Http\Request;



class Show extends Component
{
    public function render()
    {
        //findBySlug($request->slug)
        return view('livewire.knowledgebase.categories.show',
        [
            'items' => knowledgebaseArticles::get()
          ]);
    }
}
