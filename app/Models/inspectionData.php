<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Elevator;
use Carbon\Carbon;
use OwenIt\Auditing\Contracts\Auditable;

class InspectionData extends Model  implements Auditable
{
   
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['zin_code','comment','type','status','inspection_id'];
public $table = 'inspections_data';
    // protected $appends = ['elevator'];


    public function elevator()
    {
        return $this->hasOne(Elevator::class, 'id', 'elevator_id');
    }
     
}
