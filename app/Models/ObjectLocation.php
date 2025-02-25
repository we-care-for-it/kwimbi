<?php
namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class location
 *
 * @property $id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 * @property $name
 * @property $zipcode
 * @property $place
 * @property $address
 * @property $slug
 * @property $complexnumber
 * @property $management_id
 * @property $customer_id
 *
 * @package App
 * @mixin Builder
 */
class ObjectLocation extends Model implements Auditable
{
    use SoftDeletes;

    use \OwenIt\Auditing\Auditable;

    // Validation rules for this model
    static $rules = [];

    // Number of items to be shown per page
    protected $perPage = 20;

    // Attributes that should be mass-assignable
    protected $fillable = ['surface',
        'levels',
        'gps_lon',
        'construction_year'
        , 'access_code'
        , 'gps_lat'
        , 'location_id', 'customer_id'
        , 'access_contact'
        , 'location_key_lock'
        , 'province', 'complexnumber',
        'management_company_id'
        , 'municipality'
        , 'housenumber',
        'image',

        'building_type_id', 'building_access_type_id', 'remark', 'building_type_id', 'name', 'zipcode', 'place', 'address', 'slug', 'complexnumber', 'management_id'];

    public function relation()
    {
        return $this->hasOne(Relation::class, 'id', 'customer_id')->where('company_id', Filament::getTenant()->id);
    }

    public function objectbuildingtype()
    {
        return $this->belongsTo(ObjectBuildingType::class, 'building_type_id', 'id');
    }

    public function buildingtype()
    {
        return $this->belongsTo(ObjectBuildingType::class, 'building_type_id', 'id');
    }

    public function managementcompany()
    {
        return $this->hasOne(Relation::class, 'id', 'management_id');
    }

    public function objects()
    {
        return $this->hasMany(Elevator::class, 'address_id', 'id');
    }

    public function objects_same_complex()
    {
        return Elevator::whereHas('locations', function ($query) {
            return $query->where('complexnumber', '=', 1);
        })->get();
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'item_id', 'id')->where('company_id', Filament::getTenant()->id)->where('model', 'ObjectLocation');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'item_id', 'id')->where('model', 'ObjectLocation');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'location_id', 'id');
    }
    public function contactsObject()
    {
        return $this->hasMany(ContactObject::class, 'model_id', 'id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'location_id', 'id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

}
