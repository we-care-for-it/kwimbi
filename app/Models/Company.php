<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\CompanyTypes;

class Company extends Model
{



    use HasFactory;
    use SoftDeletes;

   

    public function type()
    {
        return $this->belongsTo(companyType::class);
    }

    
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }



}
