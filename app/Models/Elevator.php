<?php

namespace App\Models;

use App\Http\Livewire\Relation\Maintenance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//Models
use App\Models\inspectionCompany;
use App\Models\Customer;
use App\Models\maintenanceCompany;
use App\Models\Address;
use App\Models\Incident;
use App\Models\Inspections;
use OwenIt\Auditing\Contracts\Auditable;

use App\Models\Maintenances;
use App\Models\Management;
use App\Models\Inspection;
use App\Models\MaintenancyContracts;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Carbon\Carbon;

class Elevator extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $appends = [''];
    protected $fillable = [
     'customer_id',
     'address_id',
     'name',
     'maintenance_company',
     'unit_no',
     'nobo_no',
     'remark',
     'managment_id',
     'check_date',
     'check_date_valid',
     'building_id',
     'construction_year',
     'description',
     'check_valid_date',
     'inspection_company_id',
     'check_remark',
     'supplier_id',
     'status_id',
     'maintenance_company_id',
     'total_maintenance_year',
     'stand_still',
     'speakconnection',
     'inspection_plandate',
     'install_no'
    ];


    public function address()
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }

    public function management()
    {
        return $this->hasOne(managementCompanies::class, 'id', 'management_id');
    }

    public function maintenancecompany()
    {
        return $this->hasOne(maintenanceCompany::class, 'id', 'maintenance_company_id');
    }

    public function inspectioncompany()
    {
        return $this->hasOne(inspectionCompany::class, 'id', 'inspection_company');
    }

    public function MaintenancyContracts()
    {
        return $this->hasMany(MaintenancyContracts::class);
    }

    public function latestInspection()
{
    return $this->hasOne(Inspection::class)->where('status_id',3)->latestOfMany();
}




    public function inspections()
    {
        return $this->hasMany(Inspection::class)->orderby('executed_datetime', 'desc');
    }



    public function inspectionLatest()
    {
        return $this->hasOne(Inspection::class)->latest();
    }

    public function ownElevator()
    {
        return $this->hasMany(Address::class, 'id', 'address_id')->where('customer_id', '3');
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenances::class);
    }
    public function incident_status_new()
    {
        return $this->hasOne(Incident::class)->where('status_id', '0');
    }

    public function getinspectionCompanyAttribute()
    {
        if ($this->attributes["inspection_company_id"]) {
            return inspectionCompany::find($this->attributes["inspection_company_id"]);
        }
    }


    public function uploads()
    {
        return $this->hasMany(Upload::class, "elevator_id", "id")    ->where("group_id", 1);
    }

    public function incidents()
    {
        return $this->hasMany(Incident::class, "elevator_id", "id")->orderby('created_at', 'DESC');
        ;
    }







    public function getcountAllIncidentAttribute()
    {
        return  Incident::where('elevator_id', $this->attributes["id"])->get()->count();
    }

    //  public function getmanagementInfoAttribute()
    //  {
    //    if ($this->attributes["management_id"]) {
    // $data = Management::where('id', $this->attributes["management_id"])->first();


    //  return Management::where('id', $this->attributes["management_id"])->first();
    //}
    //  }

    // public function getmanagementIdAttribute()
    //  {
    //     if ($this->attributes["management_id"]) {
    //        $address = Address::where('id', $this->attributes["address_id"])->first();
    //  return $address->management_id;
    //    }
    // }





    //public function getmanagementAttribute()
    //  {
    //    //   return $this->attributes["management_id"];
    //    if ($this->attributes["management_id"]) {
    ///      return Management::find($this->attributes["management_id"]);
    //  }
    //  }


    //Laat zien of deze lift afgekeurd is
    public function getdisapprovedStateAttribute()
    {
        // return Inspection::where('elevator_id', $this->attributes["id"])->first();
    }
}
