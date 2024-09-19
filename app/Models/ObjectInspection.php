<?php

namespace App\Models;

use App\Enums\QuoteTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

use Carbon\Carbon;
use App\Enums\InspectionStatus;

class ObjectInspection extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;


    protected function casts(): array
    {
        return [
            'status_id' => InspectionStatus::class,
        ];
    }


    public function elevator()
    {
        return $this->belongsTo(Elevator::class);
    }

    public function itemdata()
    {
        return $this->hasMany(ObjectInspectionData::class,'inspection_id','id');
    }

    public function inspectioncompany()
    {
        return $this->belongsTo(ObjectInspectionCompany::class,'inspection_company_id','id');
    }



}
