<?php
namespace App\Models;

use App\Enums\ProjectStatus;
use App\Models\Statuses;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;
use Relaticle\CustomFields\Models\Concerns\UsesCustomFields;
use Relaticle\CustomFields\Models\Contracts\HasCustomFields;

class Project extends Model implements Auditable, HasCustomFields
{
    //  use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    use HasFilamentComments;
    use UsesCustomFields;
    public function location()
    {
        return $this->hasOne(relationLocation::class, 'id', 'location_id');
    }

    static $rules = [
        'name'        => 'required',
        'customer_id' => 'required',
    ];

    protected function casts(): array
    {
        return [
            'status_id' => ProjectStatus::class,

        ];
    }

    // Number of items to be shown per page
    protected $perPage = 20;

    // Attributes that should be mass-assignable
    protected $fillable = ['slug', 'name', 'description', 'code', 'customer_id', 'progress', 'end_date', 'begin_date', 'status_id', 'budget_hours', 'budget_costs', 'contact_person_name'];

    public function status()
    {
        return $this->hasOne(Statuses::class, 'id', 'status_id')->where('model', 'project');
    }

    public function customer()
    {
        return $this->belongsTo(Relation::class, 'customer_id', 'id');
    }
    public function uploads()
    {
        return $this->hasMany(Upload::class, 'item_id', 'id');
    }

    public function reactions()
    {
        return $this->hasMany(ProjectReaction::class, 'project_id', 'id');
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class, 'project_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function locations()
    {
        return $this->hasMany(relationLocation::class, 'project_id', 'location_id');
    }

    public function timeTracking()
    {
        return $this->hasMany(\App\Models\timeTracking::class);
    }
}
