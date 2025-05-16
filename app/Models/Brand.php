<?php
namespace App\Models;

use App\Models\assetModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    // public function company(): BelongsTo
    // {
    //     return $this->belongsTo(Company::class);
    // }

    public function models()
    {
        return $this->hasMany(assetModel::class, 'brand_id');
    }
}
