<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Customer;
use App\Models\Building;
use App\Models\Elevator;
use Carbon\Carbon;

use OwenIt\Auditing\Contracts\Auditable;

class Document extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = [
'filename','type_id', 'title'


    ];



    protected $appends = ['typename','elevator'];

    public function getelevatorAttribute()
    {
        if (isset($this->attributes["elevator_id"])) {
            return Elevator::find($this->attributes["elevator_id"]);
        }
    }






    public function gettypenameAttribute()
    {
        switch ($this->attributes["type_id"]) {
            case 1:
                return "Onderhoudsovereenkomsten";
                break;
            case 2:
                return "Meerjaren begroting";
                break;
            case 3:
                return "Gespreksverslagen";
                break;
            case 4:
                return "Keuringsrapporten";
                break;
        }
    }
}
