<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;
use Relaticle\CustomFields\Models\Concerns\UsesCustomFields;
use Relaticle\CustomFields\Models\Contracts\HasCustomFields;

class Relation extends Model implements HasCustomFields
{
    use HasFactory;
    use SoftDeletes;
    use HasFilamentComments;
    use UsesCustomFields;
    protected $fillable = [
        'name',
    ];

    protected function casts(): array
    {
        return [
            //  'type_id' => RelationTypes::class,
        ];
    }

    // protected static function booted(): void
    // {
    //     static::addGlobalScope(function ($query) {
    //         $query;
    //     });
    // }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'customer_id', 'id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function type()
    {
        return $this->belongsTo(relationType::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'model_id', 'id')->where('model', 'relation');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function relation()
    {
        return $this->belongsTo(Relation::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'item_id', 'id')->where('model', 'Relation');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function objects()
    {
        return $this->hasMany(Elevator::class, 'customer_id', 'id');
    }
    public function contactsObject(): HasMany
    {
        return $this->hasMany(ContactObject::class, 'model_id', 'id');
    }

    // public function locations()
    // {
    //     return $this->hasMany(ObjectLocation::class);
    // }

    public function timeTracking()
    {
        return $this->hasMany(timeTracking::class);
    }

    public function locations()
    {
        return $this->hasMany(relationLocation::class);
    }

    public function parentaddress()
    {
        return $this->hasOne(relationLocation::class)->where('type_id', 1);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'item_id', 'id')->where('model', 'Relation');
    }

}
