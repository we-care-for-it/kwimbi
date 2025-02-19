<?php
namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Vehicle extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'kenteken',

    ];

    ///protected $appends = ['location_name'];

    public function GpsData()
    {
        return $this->hasMany(gpsObjectData::class)->where('params_acc', 0)->orderby('created_at', 'desc');
    }

    public function GpsDataLatestLocation()
    {
        return $this->hasOne(gpsObjectData::class)->where('params_acc', 0)->latest();
    }

    public function GPSObject()
    {
        return $this->hasOne(gpsObject::class);
    }
    public function GPSObjectsForThisTenant()
    {
        return $this->hasMany(gpsObject::class)->where('company_id', Filament::getTenant()->id);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

}
