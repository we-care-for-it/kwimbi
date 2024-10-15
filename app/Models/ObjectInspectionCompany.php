<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;


class ObjectInspectionCompany extends Model 
{
  
    use SoftDeletes;
    public $table = "object_inspection_companies";
    protected $fillable = [
        'name','address','zipcode','phonenumber','general_emailaddress','place','active','website'
    ];




}
