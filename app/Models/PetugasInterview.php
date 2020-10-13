<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Binaan;
use App\Models\User;

class PetugasInterview extends Model
{
    protected $fillable = ['asal_petugas', 'binaan_id', 'nama_petugas', 'asal_petugas'];

    public function binaan()
    {
        return $this->belongsTo(Binaan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
