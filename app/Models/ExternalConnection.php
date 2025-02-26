<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class externalConnection extends Model
{
    use HasFactory;
    public $table = "external";

    // protected static function booted(): void
    // {
    //     static::addGlobalScope(function ($query) {
    //         $query->where('company_id', Filament::getTenant()->id);
    //     });
    // }

    // protected static function boot(): void
    // {
    //     parent::boot();

    //     static::saving(function ($model) {
    //         $model->company_id = Filament::getTenant()->id;
    //     });

    // }

    public function relation()
    {
        return $this->belongsTo(Relation::class);
    }

    public function lastLog()
    {
        return $this->hasOne(ExternalApiLog::class, 'external_id', 'id')->orderBy('created_at', 'desc');
    }

}
