<?php

namespace App\Models;

use App\Observers\ProjectReactionObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Builder;
use Filament\Facades\Filament;


 
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
 
#[ObservedBy([ProjectReactionObserver::class])]
class ProjectReaction extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

 
    // Attributes that should be mass-assignable
    protected $fillable = ['company_id','reaction','status_id','user_id'];

     
    public function status()
    {
        return $this->hasMany(Statuses::class,'id','status_id')->where('model', 'Project');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
