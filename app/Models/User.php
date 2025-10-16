<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Team;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Relación uno a uno con el perfil de jugador
     */
    public function playerProfile()
    {
        return $this->hasOne(\App\Models\PlayerProfile::class);
    }

    // app/Models/User.php

   

    public function team()
    {
        return $this->belongsTo(Team::class, 'current_team_id');
    }

    public function profile()
    {
        return $this->hasOne(PlayerProfile::class, 'user_id');
    }
    
    public function participations()
    {
        return $this->hasMany(GameParticipation::class, 'user_id');
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    //funciones de enviar la solicitud
    public function currentTeam()
    {
        return $this->belongsTo(\App\Models\Team::class, 'current_team_id');
    }

    public function isCaptain()
    {
        return $this->role === 'captain';
    }

    public function sentInvitations()
    {
        return $this->hasMany(\App\Models\TeamInvitation::class, 'sender_id');
    }

    public function receivedInvitations()
    {
        return $this->hasMany(\App\Models\TeamInvitation::class, 'receiver_id');
    }

    public function wallet(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(\App\Models\Wallet::class);
    }

    



}
