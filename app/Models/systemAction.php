<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Enums\ActionStatus;
use Carbon\Carbon;
 
class systemAction extends Model implements Auditable
{
  //  use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    public $table = "actions";
 

    protected $fillable = [
        'elevator_id'
    ];


    protected function casts(): array
    {
        return [
            'status_id' => ActionStatus::class,
             
        ];
    }


    public function itemdata()
    {
        return $this->hasMany(ObjectInspectionData::class,'action_id','id');
    }


    public function create_by_user()
    {
        return $this->hasOne(User::class,'id','create_by_user_id');
    }

    public function for_user()
    {
        return $this->hasOne(User::class,'id','for_user_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class,'id','company_id');
    }



}
