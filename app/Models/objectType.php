<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
use OwenIt\Auditing\Contracts\Auditable;
 
 
 


class objectType extends Model implements Auditable
 
{
    use SoftDeletes;

    use \OwenIt\Auditing\Auditable;
 
 
    protected $fillable = [
        'name',
        'is_active',
        
    ];



    // public function modules(){
    //     return $this->belongsTo(uploadTypeModule::class,'');
    // }



}
