<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

use Carbon\Carbon;
 
class warehouse extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    
    protected $fillable = ['name'];
    // protected $fillable = [
   //     'last_action_at',
    // /    'code',
   //     'location_id',
    // ];

    ///protected $appends = ['location_name'];


    public function subs(){
        return $this->hasMany(Subwarehouse::class,'id','warehouse_id');
    }



}
