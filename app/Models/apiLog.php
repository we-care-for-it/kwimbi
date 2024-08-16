<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 

class apiLog extends Model
{

   
    use HasFactory;
 
   // Attributes that should be mass-assignable
   protected $fillable = ['api','module','result','errorcode','error_description'];
  


}
 



 