<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
 

class Upload extends Model  implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'type',
        'filename',
        'elevator_id',
        'add_by_user_id',
        'incident_id',
        'relation_id',
        'type_id',        
        'directory',
        'path',
        'group_id',
        'title'
    ];
}
