<?php
namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Stephenjude\FilamentTwoFactorAuthentication\TwoFactorAuthenticatable;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory, Notifiable, LogsActivity, TwoFactorAuthenticatable, HasApiTokens, HasRoles, AuthenticationLoggable;

    public function canAccessPanel(Panel $panel): bool
    {

        if ($panel->getId() === 'app') {
            return true;
        }
    }

    public function canImpersonate()
    {
        return true;
    }

    // public function canBeImpersonated()
    // {

    //     return true;
    //     // return str_ends_with($this->email, '@ltssoftware.nl');
    // }

    // public function getFilamentAvatarUrl(): ?string
    // {
    //     $avatarColumn = config('filament-edit-profile.avatar_column', 'avatar_url');
    //     return $this->$avatarColumn ? Storage::url("$this->$avatarColumn") : null;
    // }
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }
    // public function getTenantIdLabel(): string
    // {
    //     return Filament::getTenant()->id;
    // }

    // public function getCurrentId(): string
    // {
    //     return 'Active team';
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar_url',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function getAvatarAttribute($value)
    {
        if ($this->imavatar_urlage) {
            return $this->avatar_url;
        } else {
            return '/images/noavatar.jpg';
        }
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'causer'); // ✅ Corrected
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name'])
            ->logOnlyDirty()
            ->useLogName('user');
    }

    // public function companies(): BelongsToMany
    // {
    //     return $this->belongsToMany(Company::class);
    // }

    // public function company(): BelongsTo
    // {
    //     return $this->belongsTo(Company::class);
    // }

    // public function getTenants(Panel $panel): array | Collection
    // {
    //     return $this->companies;
    // }

    // public function canAccessTenant(Model $tenant): bool
    // {
    //     return $this->companies()->whereKey($tenant)->exists();
    // }

}
