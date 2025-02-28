<?php
namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    use HasFactory;

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

    protected static function booted(): void
    {
        static::addGlobalScope(function ($query) {
            $query->where('company_id', Filament::getTenant()->id);
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(AssetCategory::class);
    }

    public function model(): BelongsTo
    {
        return $this->belongsTo(AssetModel::class);
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
    
    public function relations(): HasMany
    {
        return $this->hasMany(ContactObject::class, 'model_id', 'id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function ($model) {
            $model->company_id = Filament::getTenant()->id;
        });

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
