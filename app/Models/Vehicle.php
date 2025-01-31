<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Vehicle extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    // protected $fillable = [
    //     'last_action_at',
    // /    'code',
    //     'location_id',
    // ];

    ///protected $appends = ['location_name'];
}
