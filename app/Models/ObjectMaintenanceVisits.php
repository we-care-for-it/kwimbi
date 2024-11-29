<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

use Carbon\Carbon;


class ObjectMaintenanceVisits extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
   // public $table = "object_inpection_zincodes";

    protected $fillable = ['code','description'];



    public function elevator()
    {
        return $this->belongsTo(Elevator::class);
    }


    public function maintenance_company()
    {
        return $this->hasOne(ObjectMaintenanceCompany::class, 'id', 'maintenance_company_id');
    }

}
