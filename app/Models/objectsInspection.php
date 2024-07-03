<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Elevator;
use Carbon\Carbon;
use OwenIt\Auditing\Contracts\Auditable;

class objectsInspection extends Model  implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['elevator_id','executed_datetime','remark','status_id','document','end_date','begin_date', 'certification'];

    // protected $appends = ['elevator'];


    public function elevator()
    {
        return $this->hasOne(Elevator::class, 'id', 'elevator_id');
    }
     

    
    public function replys()
    {
        return $this->hasMany(Replies::class, 'id', 'item_id')->where('module','inspection')->orderby('id', 'desc');
    }

}
