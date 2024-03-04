<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;
use OwenIt\Auditing\Contracts\Auditable;

class Maintenances extends Model  implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    
    protected $fillable = ['remark','attachment','planned_at','status_id','executed_datetime','elevator_id' , 'attachment'];

    protected $appends = [];



    //  public function getaddressAttribute()
    // {
    //if ($this->attributes["address_id"]) {
       //     return Address::find($this->attributes["address_id"]);
    // }
    // }
}
