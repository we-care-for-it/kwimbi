<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;
use Relaticle\CustomFields\Models\Concerns\UsesCustomFields;
use Relaticle\CustomFields\Models\Contracts\HasCustomFields;

class Contact extends Model implements HasCustomFields
{
    use HasFactory;
    use HasFilamentComments;
    use UsesCustomFields;
    /**
     * @var string[]
     */
    protected $casts = [
        'metadata' => 'collection',
    ];

    protected $appends = ['avatar'];

    protected $fillable = ['first_name', 'last_name', 'email', 'department', 'function', 'phone_number', 'mobile_number'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function newQuery()
    {
        return parent::newQuery()->where('type_id', 2);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(AssetCategory::class);
    }

    public function type()
    {
        return $this->belongsTo(contactType::class);
    }

    public function getAvatarAttribute($value)
    {
        // if ($this->image) {
        //    return $this->image;
        //  } else {
        return '/images/noavatar.jpg';
        //  }
    }

    public function getNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;

    }

    public function relation()
    {
        return $this->hasOne(Relation::class, 'id', 'relation_id');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function claimer(): MorphTo
    {
        return $this->morphTo();
    }

    public function relationsObject()
    {
        return $this->hasMany(ContactObject::class, 'contact_id', 'id');
    }

}
