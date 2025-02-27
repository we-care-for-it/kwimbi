<?php
namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Vehicle extends Model implements Auditable, HasMedia
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    use InteractsWithMedia;
    protected $fillable = [
        'kenteken',
        'gps_object_id',

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
        return $this->hasOne(gpsObject::class, 'id', 'gps_object_id');
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
