<?php

namespace App\Http\Livewire\Knowledgebase\Articles;
use App\Models\knowledgebaseArticles;
use App\Models\knowledgebaseCategories;
use Illuminate\Http\Request;
use Livewire\Component;



use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;
 

class Show extends Component
{


  use WithPerPagePagination;
  use WithSorting;
  use WithBulkActions;
  use WithCachedRows;
 

  public $sortField = 'id';
  public $sortDirection = 'desc';


    public function render(Request $request)
    {
        return view('livewire.knowledgebase.articles.show',[
          'items' =>   $this->rows
        ]);
    }


    public function getRowsQueryProperty()
    {

      //::findBySlug($request->slug)
        $query = knowledgebaseArticles::query();
        
      
        return $query->orderBy($this->sortField, $this->sortDirection);
    }


    
    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }



    
public function sortBy($field)
{
    if ($this->sortField === $field) {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    } else {
        $this->sortDirection = 'asc';
    }

    $this->sortField = $field;
}


}
//knowledgebaseArticles::findBySlug($request->slug)

