<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

use Carbon\Carbon;
 
class systemAction extends Model implements Auditable
{
  //  use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    public $table = "actions";
 

    protected $fillable = [
        'elevator_id'
    ];


    public function itemdata()
    {
        return $this->hasMany(ObjectInspectionData::class,'action_id','id');
    }



}
