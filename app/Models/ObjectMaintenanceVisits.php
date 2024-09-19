<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

use Carbon\Carbon;
<<<<<<<< HEAD:app/Models/ObjectInspection.php

class ObjectInspection extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

========
 
class ObjectMaintenanceVisits extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
   // public $table = "object_inpection_zincodes";
>>>>>>>> 570f38f36f5a567b987f05b61fc64559d1a673fd:app/Models/ObjectMaintenanceVisits.php
    protected $fillable = ['code','description'];



    public function elevator()
    {
        return $this->belongsTo(Elevator::class);
    }



}
