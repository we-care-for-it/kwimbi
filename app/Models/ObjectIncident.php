<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

use App\Enums\IncidentStatus;
use App\Enums\IncidentTypes;

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
            'type_id' => IncidentTypes::class,
        ];
    }



    protected $casts = [
        'metadata' => 'collection',
    ];

    
}
