<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class assetCategorie extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name','show_on_facility',
 
    ];


    public function subCategory(){
        return $this->hasMany(assetSubCategorie::class,'category_id','id');
    }
    

    


}
