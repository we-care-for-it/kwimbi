<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ObjectModel extends Model implements Auditable
{
    // use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

}
