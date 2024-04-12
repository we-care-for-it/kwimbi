<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
class knowledgebaseArticles extends Model implements Auditable
{


    use HasFactory;
    use HasSlug;
    use SoftDeletes;

    use \OwenIt\Auditing\Auditable;


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

        // Attributes that are searchable
        static $searchable = ['name'];



         public function category()
        {
            return $this->hasOne(knowledgebaseCategories::class, 'id', 'category_id');
        }

        public function user()
       {
           return $this->hasOne(User::class, 'id', 'user_id');
       }

        // public function customer()
        // {
        //     return $this->hasOne(Customer::class);
        // }


}
