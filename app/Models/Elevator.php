<?php

namespace App\Models;

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

    static $rules = [];

    use \OwenIt\Auditing\Auditable;

    // Validation rules for this model
    static $searchable = ['name', 'address', 'general_emailaddress', 'phonenumber'];

    // Number of items to be shown per page
    public $table = "elevators";

    // Attributes that should be mass-assignable
    protected $perPage = 20;

    // Attributes that are searchable
    protected $fillable = [

        'status_id', 'customer_id', 'inspection_state_id', 'supplier_id', 'remark', 'address_id', 'inspection_company_id', 'maintenance_company_id', 'stopping_places', 'carrying_capacity', 'energy_label', 'stretcher_elevator', 'fire_elevator', 'object_type_id', 'construction_year', 'nobo_no', 'name', 'unit_no'];

    public function location()
    {
        return $this->hasOne(ObjectLocation::class, 'id', 'address_id');
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
        return $this->hasOne(maintenanceCompany::class, 'id', 'maintenance_company_id');
    }


    public function maintenance_company()
    {
        return $this->hasOne(ObjectMaintenanceCompany::class, 'id', 'maintenance_company_id');
    }

    public function inspectioncompany()
    {
        return $this->hasOne(inspectionCompany::class, 'id', 'inspection_company_id');
    }

    public function getAllElevatorOnThisAddressAttribute()
    {

        return Elevator::where('address_id', $this->attributes["address_id"])->get();

    }

    public function latestInspection()
    {
        return $this->hasOne(ObjectInspections::class)->latestOfMany();
    }

    //Liftdata
    public function inspections()
    {
        return $this->hasMany(ObjectInspections::class);
    }

    public function management_company()
    {
        return $this->hasOne(ObjectManagementCompany::class, 'id', 'management_id');
    }


    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }


    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }

    public function maintenance()
    {
        return $this->hasMany(ObjectMaintenances::class);
    }

    public function maintenance_contracts()
    {
        return $this->hasMany(maintenanceContract::class);
    }


}
