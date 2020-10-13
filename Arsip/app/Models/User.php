<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\UserAction;
use App\Models\Role;
use Auth; 

class User extends Authenticatable
{
    use Notifiable, UserActivities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userAction()
    {
        return $this->hasMany(UserAction::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function isRole($role)
    {
        return Auth::user()->roles->contains('name', $role)??false;
    }

    public function binaan()
    {
        return $this->belongsToMany(Binaan::class, 'proses_binaan')->withPivot('proses_id', 'tanggal')->withTimestamps();
    }

    public function proses()
    {
        return $this->belongsToMany(Proses::class, 'proses_binaan')->withPivot('binaan_id', 'tanggal')->withTimestamps();
    }
}
