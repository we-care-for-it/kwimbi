<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Address;
use App\Models\User;
use App\Models\Elevator;
use OwenIt\Auditing\Contracts\Auditable;

use Carbon\Carbon;
use DB;

class IncidentReplies extends Model  implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    
    protected $fillable = ['status_id', 'created_at'];
    protected $table = 'incident_replies';
    protected $appends = [];


    public function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }



}
