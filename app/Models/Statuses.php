<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Supplier
 *
 
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Statuses extends Model
{
    use SoftDeletes;

  
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
    
    
}
