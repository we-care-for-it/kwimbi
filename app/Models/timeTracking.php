<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class timeTracking extends Model implements Auditable
{

    use SoftDeletes;

    use \OwenIt\Auditing\Auditable;
    public $table       = "time_tracking";
    protected $fillable = ['user_id', 'note'];

}
