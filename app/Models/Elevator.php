<?php
namespace App\Models;

use App\Enums\ElevatorStatus;
use App\Enums\InspectionStatus;
use App\Enums\ObjectMonitoringConnect;
use App\Models\ObjectInspection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Class ManagementCompany
 *
 * @property $id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 * @property $last_edit_at
 * @property $last_edit_by
 * @property $name
 * @property $zipcode
 * @property $place
 * @property $address
 * @property $general_emailaddress
 * @property $phonenumber
 *
 * @package App
 * @mixin Builder
 */
class Elevator extends Model implements Auditable, HasMedia
{

    public $table = "elevators";
    use InteractsWithMedia;
    use SoftDeletes;
    protected function casts(): array
    {
        return [
            'status_id'                    => ElevatorStatus::class,
            'current_inspection_status_id' => InspectionStatus::class,
            'getMonitoringConnectState'    => ObjectMonitoringConnect::class,

        ];
    }
    static $rules = [];
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'status_id', 'energy_label', 'customer_id', 'management_id', 'inspection_state_id', 'supplier_id', 'remark', 'address_id', 'inspection_company_id', 'maintenance_company_id', 'stopping_places', 'carrying_capacity', 'energy_label', 'stretcher_elevator', 'fire_elevator', 'object_type_id', 'construction_year', 'nobo_no', 'name', 'unit_no',
    ];

    public function latestInspection()
    {
        return $this->hasOne(ObjectInspection::class, 'elevator_id')->latest('end_date');
    }

    public function location()
    {
        return $this->hasOne(ObjectLocation::class, 'id', 'address_id');
    }

    public function management()
    {
        return $this->hasOne(ObjectmanagementCompanies::class, 'id', 'management_id');
    }

    public function customer()
    {
        return $this->hasOne(Relation::class, 'id', 'customer_id');
    }

    public function supplier()
    {
        return $this->hasOne(Relation::class, 'id', 'supplier_id');
    }

    public function type()
    {
        return $this->hasOne(ObjectType::class, 'id', 'object_type_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function maintenance_company()
    {
        return $this->hasOne(Relation::class, 'id', 'maintenance_company_id');
    }

    public function inspectioncompany()
    {
        return $this->hasOne(Relation::class, 'id', 'inspection_company_id');
    }

    public function getAllElevatorOnThisAddressAttribute()
    {
        return Elevator::where('address_id', $this->attributes["address_id"])->get();
    }

    public function inspections()
    {
        return $this->hasMany(ObjectInspection::class, 'elevator_id', 'id')->orderby('end_date', 'desc');
    }

    public function inspection()
    {
        return $this->hasOne(ObjectInspection::class, 'id', 'elevator_id')->orderBy('end_date', 'desc')->orderBy('executed_datetime', 'desc');
    }

    // protected static function boot(): void
    // {
    //     parent::boot();

    //     static::saving(function ($model) {
    //         $model->company_id = Filament::getTenant()->id;
    //     });

    // }

    public function features()
    {
        return $this->hasMany(ObjectFeatures::class, 'object_id', 'id');
    }

    public function uploads()
    {
        return $this->hasMany(Upload::class, 'item_id', 'id');
    }

    public function incidents()
    {
        return $this->hasMany(ObjectIncident::class);
    }

    public function incident_stand_still()
    {
        return $this->hasOne(ObjectIncident::class)->where('standing_still', 1);
    }

    public function maintenance()
    {
        return $this->hasMany(ObjectMaintenances::class);
    }

    public function maintenance_contracts()
    {
        return $this->hasMany(ObjectMaintenanceContract::class);
    }

    public function maintenance_visits()
    {
        return $this->hasMany(ObjectMaintenanceVisits::class);
    }

    //Monitoring

    public function getMonitoringLastInsert()
    {
        return $this->hasOne(ObjectMonitoring::class, 'external_object_id', 'monitoring_object_id')->latest();
    }

    public function getMonitoringVersion()
    {
        return $this->hasOne(ObjectMonitoring::class, 'external_object_id', 'monitoring_object_id')->where('category', 'version')->latest('created_at');
    }

    public function getMonitoringType()
    {
        return $this->hasOne(ObjectMonitoring::class, 'external_object_id', 'monitoring_object_id')->where('category', 'type')->latest('created_at');
    }

    public function getMonitoringFloor()
    {
        return $this->hasOne(ObjectMonitoring::class, 'external_object_id', 'monitoring_object_id')->where('category', 'stop')->latest('created_at');
    }

    public function getMonitoringConnectState()
    {
        return $this->hasOne(ObjectMonitoring::class, 'external_object_id', 'monitoring_object_id')->where('category', 'connected')->latest('created_at');
    }

    public function getMonitoringState()
    {
        return $this->hasOne(ObjectMonitoring::class, 'external_object_id', 'monitoring_object_id')->where('category', 'state')->latest('created_at');
    }

}
