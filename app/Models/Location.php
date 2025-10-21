<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @method static create(array $array)
 */
class Location extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    public function workplaces(): HasManyThrough
    {
        return $this->hasManyThrough(Workplace::class, Department::class);
    }

  public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
