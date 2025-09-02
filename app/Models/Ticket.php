<?php
namespace App\Models;

use App\Enums\Priority;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{

    use SoftDeletes;
    protected $casts = [

        'prio' => Priority::class,

    ];

    public function relation()
    {
        return $this->belongsTo(Relation::class);
    }

    public function type()
    {
        return $this->belongsTo(ticketType::class, 'type_id', 'id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function location()
    {
        return $this->hasOne(relationLocation::class, 'id', 'location_id');
    }

    public function status()
    {
        return $this->belongsTo(ticketStatus::class, 'status_id', 'id');
    }

    public function timeTracking()
    {
        return $this->hasMany(timeTracking::class, 'ticket_id', 'id');
    }

    public function AssignedByUser()
    {
        return $this->hasOne(User::class, 'id', 'assigned_by_user');
    }

    public function createByUser()
    {
        return $this->hasOne(Contact::class, 'id', 'created_by_user');
    }

    public function replies()
    {
        return $this->hasMany(ticketReplies::class);
    }

    public function object()
    {
        return $this->hasOne(ObjectsAsset::class, 'id', 'asset_id');
    }

    public function objects(): HasMany
    {
        return $this->hasMany(assetToTicket::class, 'ticket_id', 'id');

    }

}
