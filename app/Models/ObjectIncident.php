<?php
namespace App\Models;

use App\Enums\IncidentStatus;
use App\Enums\IncidentTypes;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectIncident extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */

    protected function casts(): array
    {
        return [
            'status_id' => IncidentStatus::class,
            'type_id'   => IncidentTypes::class,
        ];
    }

    protected static function boot(): void
    {
        parent::boot();
        static::saving(function ($model) {
            $model->company_id = Filament::getTenant()->id;
        });

    }

    protected $casts = [
        'metadata' => 'collection',
    ];

}
