<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserAction;
use Auth;

trait UserActivities
{
    protected static function bootUserActivities()
    {
        static::created(function($model){
            $model->userActivity('created');
        });
        static::updated(function($model){
            $model->userActivity('updated');
        });
        static::deleted(function($model){
            $model->userActivity('deleted');
        });
    }

    protected function userActivity($event)
    {
        if (Auth::check()) {
            UserAction::create([
                'user_id'      => Auth::user()->id,
                'action'       => $event,
                'action_model' => $this->getTable(),
                'action_id'    => $this->id
            ]);
        }
    }

}
