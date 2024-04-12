<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class knowledgebaseCategories extends Model
{

    use HasFactory;
    use HasSlug;

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    
    public function articles()
    {
      return $this->hasMany(knowledgebaseArticles::class, 'category_id', 'id')->orderby('id', 'desc');
    }


}
 



 