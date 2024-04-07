<?php

namespace App\Models;

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
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
 

 
 


class Elevator extends Model implements Auditable
 
{
    use SoftDeletes;
 
    use \OwenIt\Auditing\Auditable;
 
    // Validation rules for this model
    static $rules = [];

    // Number of items to be shown per page
    protected $perPage = 20;

    // Attributes that should be mass-assignable
    protected $fillable = [
       
        'status_id',   'customer_id', 'inspection_state_id','supplier_id','remark','address_id','inspection_company_id','maintenance_company_id','stopping_places','carrying_capacity','energy_label','stretcher_elevator','fire_elevator','object_type_id','construction_year','nobo_no','name','unit_no'];

    // Attributes that are searchable
    static $searchable = ['name','address','general_emailaddress','phonenumber'];
  
    public function location()
    {
        return $this->hasOne(Location::class,'id','address_id' );
    }

    public function address()
    {
        return $this->hasOne(Location::class, 'id', 'address_id');
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

    public function maintenancecompany()
    {
        return $this->hasOne(maintenanceCompany::class, 'id', 'maintenance_company_id');
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
        return $this->hasOne(Inspection::class)->latestOfMany();
    }

    //Liftdata
    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }
    public function maintenance()
    {
        return $this->hasMany(Maintenances::class);
    }

    public function maintenance_contracts()
    {
        return $this->hasMany(maintenanceContract::class);
    }


    





}
