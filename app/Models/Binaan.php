<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PetugasInterview;
use App\Models\Proses;
use App\Models\User;

class Binaan extends Model
{
    protected $fillable = ['nama', 'no_register', 'pidana', 'expirasi', 'sepertiga_mp', 'seperdua_mp'];

    public function petugasInterview()
    {
        return $this->hasOne(PetugasInterview::class);
    }

    public function proses()
    {
        return $this->belongsToMany(Proses::class, 'proses_binaans')->withPivot('user_id', 'tanggal')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'proses_binaans')->withPivot('proses_id', 'tanggal')->withTimestamps();
    }
}
