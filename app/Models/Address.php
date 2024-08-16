<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Customer;
use App\Models\managementCompany;
use App\Models\Elevator;
use OwenIt\Auditing\Contracts\Auditable;

// use Spatie\Sluggable\HasSlug;
//  use Spatie\Sluggable\SlugOptions;


use App\Models\maintenanceCompany;
use Carbon\Carbon;

class Address extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    use HasFactory;
    // use HasSlug;

    protected $table = 'address';

    protected $fillable = [
        'name','address','zipcode','phonenumber','complexnumber','place','customer_id','management_id'
    ];

    // public function getSlugOptions() : SlugOptions
    // {
    //     return SlugOptions::create()
    //     ->generateSlugsFrom(['name', 'address'])
    //         ->saveSlugsTo('slug');
    // }


     public function objects()
    {
        return $this->hasMany(Elevator::class);
    }

    public function customer()
    {
        return $this->hasOne(customer::class, 'id', 'customer_id');
    }
  
    public function management()
    {
        return $this->hasOne(managementCompany::class, 'id', 'management_id');
    }

        
}






 