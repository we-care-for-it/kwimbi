<?php

namespace App\Models;

use Filament\Facades\Filament;
use App\Enums\RelationTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    protected function casts(): array
    {
        return [
            'type_id' => RelationTypes::class,
        ];
    }

    // protected static function booted(): void
    // {
    //     static::addGlobalScope(function ($query) {
    //         $query->where('company_id', Filament::getTenant()->id);
    //     });
    // }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
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

    public function tasks()
    {
        return $this->hasMany(Task::class, 'model_id', 'id')->where('model', 'relation')->where('company_id', Filament::getTenant()->id);
    }


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contactsObject(): HasMany
    {
        return $this->hasMany(ContactObject::class, 'model_id', 'id');
    }

    public function locations()
    {
        return $this->hasMany(ObjectLocation::class);
    }

}
