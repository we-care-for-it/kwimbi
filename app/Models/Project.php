<?php

namespace App\Models;

use App\Models\Statuses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
use Log;
use Str;
class Project extends Model implements Auditable
{
  //  use SoftDeletes;
    use \OwenIt\Auditing\Auditable;


    public function location()
    {
        return $this->hasOne(ObjectLocation::class, 'id', 'location_id');
    }

    static $rules = [
      'name' => 'required',
      'customer_id' => 'required',
    ];

    // Number of items to be shown per page
    protected $perPage = 20;

    // Attributes that should be mass-assignable
    protected $fillable = ['slug','name','description','code','customer_id','progress','end_date','begin_date','status_id','budget_hours','budget_costs','contact_person_name'];

    public function status()
    {
        return $this->hasOne(Statuses::class,'id','status_id')->where('model', 'Project');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
  public function uploads()
    {
        return $this->hasMany(Upload::class,'item_id','id');
    }

    public function reactions()
    {
        return $this->hasMany(ProjectReaction::class,'project_id','id');
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class,'project_id','id');
    }



    public function locations()
    {
        return $this->hasMany(ProjectLocation::class,'project_id','location_id');
    }

 

}
