<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'avatar',
        'provider',
        'provider_id',
        'access_token',
        'invited_by'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function getFullName() {

        return "$this->first_name $this->last_name";

    }

    public function setInvitationToken() {
        $this->invitation_token = Str::random(60);
        $this->save();
    }

    public function getInvitationToken() {
        if (empty($this->invitation_token)) {
            $this->setInvitationToken();
        }
        return $this->invitation_token;
    }
}
