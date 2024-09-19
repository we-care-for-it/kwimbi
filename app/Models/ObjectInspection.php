<?php

namespace App\Models;

use App\Enums\InspectionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;


class ObjectInspection extends Model implements Auditable
{

    protected $fillable = ['code', 'description'];


    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public function elevator()
    {
        return $this->hasOne(Elevator::class, 'id', 'elevator_id');
    }

    public function InspectionCompany()
    {
        return $this->hasOne(ObjectInspectionCompany::class, 'id', 'inspection_company_id');
    }


    protected function casts(): array
    {
        return [
            'status_id' => InspectionStatus::class,
        ];
    }


}
