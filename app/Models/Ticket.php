<?php
namespace App\Models;

use App\Enums\Priority;
use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ticket extends Model
{

    protected $casts = [
        'status_id' => TicketStatus::class,
        'prio'      => Priority::class,
        'type_id'   => TicketStatus::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function ($item) {
            $item->created_by_user = Auth::user()->id;
        });
    }

    public function relation()
    {
        return $this->belongsTo(Relation::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function AssignedByUser()
    {
        return $this->hasOne(User::class, 'id', 'assigned_by_user');
    }

    public function createByUser()
    {
        return $this->hasOne(User::class, 'id', 'created_by_user');
    }

}
