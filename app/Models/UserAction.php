<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{
    protected $fillable = ['user_id', 'action', 'action_model', 'action_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
