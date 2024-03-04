<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
 


use Carbon\Carbon;

class Contact extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    // protected $table = 'address';

    protected $fillable = [
        'function',    'name','phonenumber','email','management_id','supplier_id','maintency_company_id','inspection_company_id','management_id', 'customer_id'
    ];
   
    public function Address()
    {
        return $this->hasMany(Address::class);
    }


 


    public function managementCompany()
    {
        return $this->hasOne(managementCompany::class, 'id', 'management_id');
    }


    public function inspectionCompany()
    {
        return $this->hasOne(inspectionCompany::class, 'id', 'inspection_company_id');
    }


    public function Supplier()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }




    public function maintenanceCompany()
    {
        return $this->hasOne(maintenanceCompany::class, 'id', 'maintency_company_id');
    }


    
    public function customer()
    {
        return $this->hasOne(Customer::class,'id', 'customer_id');
    }



    






    // protected $fillable = [
    //     'last_action_at',
    // /    'code',
    //     'location_id',
    // ];

    ///protected $appends = ['location_name'];
}
