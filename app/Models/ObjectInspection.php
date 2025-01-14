<?php
namespace App\Models;

use App\Enums\InspectionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        return $this->belongsTo(Elevator::class, 'elevator_id', 'id');
    }

    public function itemdata()
    {
        return $this->hasMany(ObjectInspectionData::class, 'inspection_id', 'id');
    }

    public function actions()
    {
        return $this->hasMany(systemAction::class, 'item_id', 'id')->where('model', 'ObjectInspection');
    }

    public function inspectioncompany()
    {
        return $this->belongsTo(Company::class, 'inspection_company_id', 'id')->withTrashed();
    }

}
