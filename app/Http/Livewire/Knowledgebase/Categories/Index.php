<?php

namespace App\Http\Livewire\Knowledgebase\Categories;

use Livewire\Component;

use App\Models\knowledgebaseArticles;
use App\Models\knowledgebaseCategories;


class Index extends Component
{
    public function render()
    {

        $categories = knowledgebaseCategories::where('is_active',1 )->orderBy('name', 'asc')->get();

    $groups = $categories->reduce(function ($carry, $category) {

        // get first letter
        $first_letter = $category['name'][0];

        if ( !isset($carry[$first_letter]) ) {
            $carry[$first_letter] = [];
        }

        $carry[$first_letter][] = $category;

        return $carry;

    }, []);

    return view('livewire.knowledgebase.categories.index')->with('groups', $groups);


      
    
     
    }
}
