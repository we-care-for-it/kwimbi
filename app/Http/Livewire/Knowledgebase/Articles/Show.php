<?php

namespace App\Http\Livewire\Knowledgebase\Articles;
use App\Models\knowledgebaseArticles;
use App\Models\knowledgebaseCategories;
use Illuminate\Http\Request;
use Livewire\Component;

class Show extends Component
{

  
public $edit_id;
public $title;
public $article; 
public $body; 


public function save(Request $request){
  dd($request->quill-editor);
}
    public function render(Request $request)
    {

      $article = knowledgebaseArticles::findBySlug($request->slug);

      $this->title = $article->title;
      $this->body = $article->article;

      $this->article = $article;
      
        return view('livewire.knowledgebase.articles.show',[
          'article' => $article
        ]);
    }
}
