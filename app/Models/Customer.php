<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use OwenIt\Auditing\Contracts\Auditable;


class Customer extends Model implements Auditable

{
    // use HasFactory;
    // use HasSlug;

    use \OwenIt\Auditing\Auditable;

    protected $table = 'customers';



    
    // public function getSlugOptions() : SlugOptions
    // {
    //     return SlugOptions::create()
    //     ->generateSlugsFrom(['name', 'address'])
    //         ->saveSlugsTo('slug');
    // }




    protected $fillable = [
        'name','address','zipcode','phonenumber','emailaddress','place','phonenumber'
    ];


}