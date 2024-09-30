<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;


class Customer extends Model implements Auditable

{
    // use HasFactory;
    use SoftDeletes;

    use \OwenIt\Auditing\Auditable;

    protected $table = 'customers';



    public function locations()
    {
        return $this->hasMany(ObjectLocation::class, 'customer_id', 'id');
    }

    public function objects()
    {
      return $this->hasMany(Elevator::class, 'customer_id', 'id');
    }






    protected $fillable = [
        'name','address','zipcode','phonenumber','emailaddress','place','phonenumber','slug'
    ];


}
