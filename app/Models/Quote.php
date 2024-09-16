<?php

namespace App\Models;

use App\Models\Statuses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
use Log;
use Str;
use App\Enums\QuoteTypes;
class Quote extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;



    protected function casts(): array
    {
        return [
            'type_id' => QuoteTypes::class,
        ];
    }

    // Attributes that should be mass-assignable
    protected $fillable = ['number','type'];


    public function status()
    {
        return $this->hasMany(Statuses::class,'id','status_id');
    }

    public function project()
    {
        return $this->hasOne(Project::class,'id','project_id');
    }




    public function supplier()
    {
        return $this->hasOne(Supplier::class,'id','company_id');
    }


}
