<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ObjectType extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'is_active',
        'has_inspections',
        'has_incidents',
        'has_maintencycontracts',
        'has_maintency',
        'has_tickets',
    ];

    protected $casts = [
        'is_active'              => 'boolean',
        'has_inspections'        => 'boolean',
        'has_incidents'          => 'boolean',
        'has_maintencycontracts' => 'boolean',
        'has_maintency'          => 'boolean',
        'has_tickets'            => 'boolean',
    ];

    public function customFields()
    {
        return $this->hasMany(customFieldinModel::class, 'model_id');
    }

}
