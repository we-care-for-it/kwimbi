<?php

namespace App\Models;

use App\Enums\QuoteTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 

use Carbon\Carbon;
use App\Enums\InspectionStatus;



class ObjectInspection extends Model  
{
    use SoftDeletes;
 

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
        return $this->belongsTo(ObjectInspectionCompany::class,'inspection_company_id','id')->withTrashed();
    }



}
