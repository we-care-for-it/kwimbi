<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Address;
use App\Models\User;
use App\Models\Elevator;
use App\Models\IncidentReplies;
use OwenIt\Auditing\Contracts\Auditable;
use Carbon\Carbon;
use DB;

class Incident extends Model  implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['contactperson_address','contactperson','contactperson_phonenumber','stand_still','status_id','description','subject','document'];
  //  protected $appends = ['address'];




    public function getcountReactionsAttribute()
    {
        return 0;
    }






    public function elevator()
    {
        return $this->hasOne(elevator::class, "id", "elevator_id");
    }

    public function reporter()
    {
        return $this->hasOne(User::class, "id", "reporter_id");
    }

    public function uploads()
    {
        return $this->hasMany(Upload::class, "incident_id", "id")->where("group_id", 2);
    }


    public function address()
    {
        return $this->hasMany(Address::class, "id", "elevator.address_id");
    }






    public function replys()
    {
        return $this->hasMany(IncidentReplies::class)->orderby('id', 'desc');
    }
}
