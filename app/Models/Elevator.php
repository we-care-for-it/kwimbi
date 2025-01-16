<?php
namespace App\Models;

use App\Enums\ElevatorStatus;
use App\Models\ObjectInspection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

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
class Elevator extends Model implements Auditable
{
    use SoftDeletes;
    protected function casts(): array
    {
        return [
            'status_id' => ElevatorStatus::class,
            //   'current_inspection_status_id' => InspectionStatus::class,

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
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

    public function type()
    {
        return $this->hasOne(ObjectType::class, 'id', 'object_type_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'maintenance_company_id');
    }

    public function maintenance_company()
    {
        return $this->hasOne(Company::class, 'id', 'maintenance_company_id');
    }

    public function inspectioncompany()
    {
        return $this->hasOne(Company::class, 'id', 'inspection_company_id');
    }

    public function getAllElevatorOnThisAddressAttribute()
    {
        return Elevator::where('address_id', $this->attributes["address_id"])->get();
    }

    public function inspections()
    {
        return $this->hasMany(ObjectInspection::class, 'elevator_id', 'id');
    }

    public function inspection()
    {
        return $this->hasOne(ObjectInspection::class, 'id', 'elevator_id')->orderBy('end_date', 'desc')->orderBy('executed_datetime', 'desc');
    }

    public function features()
    {
        return $this->hasMany(ObjectFeatures::class, 'object_id', 'id');
    }

    public function management_company()
    {
        return $this->hasOne(Company::class, 'id', 'management_id');
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
}
