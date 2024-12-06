<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Filament\Facades\Filament;

class Note extends Model implements Auditable

{

    protected $fillable = ['user_id', 'note','model','company_id'];
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->company_id = get_tenant_id();
        });
    }
 

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
