<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    // public function locations(): HasMany
    // {
    //     return $this->hasMany(Location::class);
    // }

    public function assetCategories(): HasMany
    {
        return $this->hasMany(AssetCategory::class);
    }

    public function assetBrands(): HasMany
    {
        return $this->hasMany(AssetBrand::class);
    }

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class);
    }
}
