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
 

 
 


class objectType extends Model implements Auditable
 
{
    use SoftDeletes;

    use \OwenIt\Auditing\Auditable;
 
 
    





}
