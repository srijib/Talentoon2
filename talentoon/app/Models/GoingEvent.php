<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoingEvent extends Model
{
    //
    protected $table = 'going_event';
    protected $fillable =['user_id','event_id'];
}
