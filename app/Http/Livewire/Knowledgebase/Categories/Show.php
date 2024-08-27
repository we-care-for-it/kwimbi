<?php

namespace App\Http\Livewire\Knowledgebase\Categories;

use Livewire\Component;
use App\Models\knowledgebaseArticles;
use App\Models\knowledgebaseCategories;
use Illuminate\Http\Request;


//Datatable
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

    public $name;
    public $sortField = 'title';
    public $sortDirection = 'desc';



    public function render()
    {
        //findBySlug($request->slug)
        return view('livewire.knowledgebase.categories.show',
        [
            'items' => $this->rows
          ]);
    }


    public function getRowsQueryProperty(Request $request)
    {

      //

      $categorie = knowledgebaseCategories::findBySlug($request->slug)->first();
        $this->name = $categorie->name;
        $query = $categorie->articles();
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
