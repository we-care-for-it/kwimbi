<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class employee extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    //  public $table = "object_building_types";
    //  protected $fillable = ['name', 'is_active'];

    public function getNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;

    }

}
