<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;

 

 
class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable, AuthenticationLoggable;
    use \OwenIt\Auditing\Auditable;
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'login_type'
    ];

    protected $auditExclude = [
        'password',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cntTasks(){
return Task::where('user_id', $this->id)->orderby('id', 'desc')->count();


    }


    public function getInitialsAttribute(){
        $name = $this->name;
        $name_array = explode(' ',trim($name));
    
        $firstWord = $name_array[0];
        $lastWord = $name_array[count($name_array)-1];
    
        return $firstWord[0]."".$lastWord[0];
    }

    
}
