<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Binaan;

class Proses extends Model
{
    protected $fillable = ['nama'];

    public function binaan()
    {
        return $this->belongsToMany(Binaan::class, 'proses_binaan')->withPivot('user_id', 'tanggal')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'proses_binaan')->withPivot('binaan_id', 'tanggal')->withTimestamps();
    }
}
