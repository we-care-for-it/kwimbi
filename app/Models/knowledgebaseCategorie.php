<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;


class knowledgebaseCategorie extends  Model implements Auditable
{

    use HasFactory;
    use HasSlug;
    use \OwenIt\Auditing\Auditable;


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function articles()
    {
      return $this->hasMany(knowledgebaseArticles::class, 'category_id', 'id')->where('is_active',1 )->orderby('id', 'desc');
    }


}
