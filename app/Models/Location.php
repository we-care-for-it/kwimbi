<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Location
 *
 * @property $id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 * @property $name
 * @property $zipcode
 * @property $place
 * @property $address
 * @property $slug
 * @property $complexnumber
 * @property $management_id
 * @property $customer_id
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Location extends Model
{
    use SoftDeletes;




    // Validation rules for this model
    static $rules = [];

    // Number of items to be shown per page
    protected $perPage = 20;

    // Attributes that should be mass-assignable
    protected $fillable = ['building_access_type_id','remark','building_type_id','name','zipcode','place','address','slug','complexnumber','management_id','customer_id'];

    // Attributes that are searchable
    static $searchable = ['name','zipcode','place','address','slug','complexnumber','management_id','customer_id','building_access_type_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function managementcompany()
    {
        return $this->hasOne(ManagementCompany::class, 'id', 'management_id');
    }



}
