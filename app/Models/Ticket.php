<?php
namespace App\Models;

use App\Enums\Priority;
use App\Enums\TicketStatus;
use App\Enums\TicketTypes;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    protected $casts = [
        'status_id' => TicketStatus::class,
        'prio'      => Priority::class,
        'type_id'   => TicketTypes::class,
    ];

    public function relation()
    {
        return $this->belongsTo(Relation::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function employeees()
    {
        return $this->belongsTo(Employee::class);
    }

    public function timeTracking()
    {
        return $this->hasMany(timeTracking::class, 'id', 'ticket_id');
    }

    public function AssignedByUser()
    {
        return $this->hasOne(User::class, 'id', 'assigned_by_user');
    }

    public function createByUser()
    {
        return $this->hasOne(Employee::class, 'id', 'created_by_user');
    }

    public function replies()
    {
        return $this->hasMany(ticketReplies::class);
    }

}
