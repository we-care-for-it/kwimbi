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

    public function GpsData()
    {
        return $this->hasMany(gpsObjectData::class, 'imei', 'gps_imei')->where('params_acc', 0)->orderby('created_at', 'desc');
    }

    public function GpsDataLatestLocation()
    {
        return $this->hasOne(gpsObjectData::class, 'imei', 'gps_imei')->where('params_acc', 0)->latest();
    }

}
