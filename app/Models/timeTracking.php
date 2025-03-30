<?php
namespace App\Models;

use App\Enums\TimeTrackingStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class timeTracking extends Model implements Auditable
{

    use SoftDeletes;

    use \OwenIt\Auditing\Auditable;
    public $table       = "time_tracking";
    protected $fillable = ['description', 'weekno', 'relation_id', 'project_id', 'status_id', 'work_type_id', 'invoiceable'];

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function ($model) {
            $model->weekno = date("W", strtotime($model->started_at));

        });

    }

    protected function casts(): array
    {
        return [
            'status_id' => TimeTrackingStatus::class,

        ];
    }

    public function relation()
    {
        return $this->belongsTo(Relation::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
