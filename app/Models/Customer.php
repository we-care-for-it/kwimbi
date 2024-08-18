<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Elevator;

use App\Models\Document;

use Carbon\Carbon;

class Customer extends Model
{
    use SoftDeletes;
    protected $fillable = [
     'emailaddress',
     'postalcode',
     'address',
     'active',
     'place',
     'mailbox',
     'name',
     'logo',
     ];




    public function Document()
    {
        return $this->hasMany(Document::class);
    }


    public function Elevator()
    {
        return $this->hasMany(Elevator::class);
    }



    ///protected $appends = ['location_name'];
}
