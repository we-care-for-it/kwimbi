<?php

namespace App\Http\Livewire\Knowledgebase\Articles;
use App\Models\knowledgebaseArticles;
use App\Models\knowledgebaseCategories;
use Illuminate\Http\Request;
use Livewire\Component;

class Show extends Component
{
    public function render(Request $request)
    {
        return view('livewire.knowledgebase.articles.show',[
          'article' => knowledgebaseArticles::findBySlug($request->slug)
        ]);
    }
}
