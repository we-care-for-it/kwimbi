<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
use OwenIt\Auditing\Contracts\Auditable;
 
class uploadTypeModule extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
 
  

     

    // Attributes that should be mass-assignable
    protected $fillable = ['upload_type_id','module_id'];
   


}
