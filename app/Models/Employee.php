<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;
use Relaticle\CustomFields\Models\Concerns\UsesCustomFields;

class Employee extends Model implements Auditable
{
    use SoftDeletes;
    use UsesCustomFields;
    use HasFilamentComments;
    use \OwenIt\Auditing\Auditable;
    //  public $table = "object_building_types";
    //  protected $fillable = ['name', 'is_active'];

    public function getNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;

    }
    public function getAvatarAttribute($value)
    {
        if ($this->image) {
            return $this->image;
        } else {
            return '/images/noavatar.jpg';
        }
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'contact_id', 'id');

    }

    public function relation(): HasMany
    {
        return $this->hasMany(Relation::class, 'id', 'relation_id');
    }
}
