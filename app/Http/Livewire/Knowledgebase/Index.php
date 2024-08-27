<?php

namespace App\Http\Livewire\Knowledgebase;
use App\Models\knowledgebaseArticles;
use App\Models\knowledgebaseCategories;


use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.knowledgebase.index',
    [
        'categories' => knowledgebaseCategories::where('is_active',1 )->get()
    ]);
    }
}
