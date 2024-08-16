<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Elevator;
use Carbon\Carbon;
use OwenIt\Auditing\Contracts\Auditable;

class Inspection extends Model  implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['if_match','nobo_number','type','inspection_company_id','external_uuid','elevator_id','executed_datetime','remark','status_id','document','end_date','begin_date', 'certification'];

    // protected $appends = ['elevator'];


    public function elevator()
    {
        return $this->hasOne(Elevator::class, 'id', 'elevator_id');
    }

    public function company()
    {
        return $this->hasOne(inspectionCompany::class, 'id', 'inspection_company_id');
    }

    public function details()
    {
        return $this->hasMany(InspectionData::class, 'inspection_id', 'id');
    }

    public function RepetitionCount()
    {
        return $this->hasOne(inspectionData::class, 'inspection_id', 'id')->where('status','Herhaling');
    }

     
}
