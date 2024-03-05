<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Address extends Model
{

    public $table = "posts";
    use HasFactory;
    use HasSlug;


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    
        // Attributes that are searchable
        static $searchable = ['name'];
    


        public function managementcompany()
        {
            return $this->hasOne(ManagementCompany::class, 'id', 'management_id');
        }


}
 



 