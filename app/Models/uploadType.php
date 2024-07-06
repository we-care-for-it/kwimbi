<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
use OwenIt\Auditing\Contracts\Auditable;
 

 
 


class uploadType extends Model implements Auditable
 
{
    
     use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
 
    // Validation rules for this model
    static $rules = [];

    // Number of items to be shown per page
    protected $perPage = 20;

    protected $fillable = [
        'name','is_active'    ];




}
