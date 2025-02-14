<?php
namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Note extends Model implements Auditable
{

    use SoftDeletes;

    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['user_id', 'note'];

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function ($model) {
            $model->company_id = Filament::getTenant()->id;
        });

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
