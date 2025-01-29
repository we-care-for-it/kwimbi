<?php
namespace App\Models;

use App\Enums\ActionTypes;
use App\Mail\ActionToUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Mail;

class Task extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $casts = [
        'metadata' => 'collection',
    ];

    protected function casts(): array
    {
        return [
            'status_id' => ActionStatus::class,
            'type_id'   => ActionTypes::class,

        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->make_by_employee_id = $user = auth()->id();;

        });

        static::saved(function (self $request) {

            //IF NOT DIRETY
            if ($request->isDirty()) {

                $user = User::where('id', $request->employee_id)->first();

                if ($user->id != Auth::id()) {
                    Mail::to("info@digilevel.nl")->send(new ActionToUser($request));
                }

            }
        });

    }

    public function employee()
    {
        return $this->hasOne(User::class, 'id', 'employee_id');
    }

    public function getRelatedToAttribute()
    {

        switch ($this->model) {
            case 'relation':
                return Customer::whereId($this->model_id)->first();
                break;
            case 'project':
                return Project::whereId($this->model_id)->first();
                break;
            case 'location':
                return ObjectLocation::whereId($this->model_id)->first();
                break;
            case 'object':
                return Elevator::whereId($this->model_id)->first();
                break;
            case 'contactperson':
                return Contact::whereId($this->model_id)->first();
                break;
            default:
                //code block
        }

    }

}
